@extends('layouts.main')

@section('content')

    <style>
        .list-group li, .list-group a {
            transition: all 0.4s;
        }
    </style>

    <div id="movies-edit-app">
        <h2>Editing movie</h2>

        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="save">
                    <div class="mb-3">
                        <label for="movie-name" class="form-label">Name</label>
                        <input v-model="movie.name" type="text" :class="{'is-invalid': errors.name}" class="form-control" id="movie-name">
                    </div>

                    <div class="mb-3">
                        <label for="movie-desc" class="form-label">Description</label>
                        <input v-model="movie.description" type="text" :class="{'is-invalid': errors.description}" class="form-control" id="movie-desc">
                    </div>

                    <button type="submit" class="btn btn-primary" :disabled="clean">Submit</button>
                    <br>
                    <div v-if="busy" class="spinner-border text-info mt-2" role="status">
                    <span class="visually-hidden">Busy...</span>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
            
                <h4>
                    Actors in the movie

                    <button class="btn btn-outline-secondary" @click="popActorSelectModal">
                        Add actor to movie
                    </button>
                </h4>

                <ul class="list-group">

                    <li 
                        :class="{'list-group-item-success': highlightedActor == actor}"
                        v-for="actor in actors" 
                        class="list-group-item" >
                        @{{ actor.name }}
                    </li>
                </ul>

                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                        <strong class="me-auto">Bootstrap</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Saved!
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" ref="actorPicker" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select an actor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <input type="text" class="form-control" v-model="search" placeholder="Search for an actor">

                        <div class="list-group">
                            <a 
                                :class="{active: selectedActor == actor}"
                                @click="selectActor(actor)"
                                v-for="actor in actorSuggestions"
                                v-text="actor.name"
                                href="#" 
                                class="list-group-item list-group-item-action" ></a>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button @click="addActorToCast" type="button" class="btn btn-primary" :disabled="!selectedActor">Add actor</button>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

@endsection

@section('page-script')
    <script>
        let movie = {!! $movie !!};
        let myEditApp = new Vue({
            el: '#movies-edit-app',
            data() {
                return {
                    movie: movie,
                    dirty: false,
                    busy: false,
                    errors: {},
                    
                    actors: [],
                    highlightedActor: null,
                    actorPicker: null,
                    search: '',
                    actorSuggestions: [],
                    selectedActor: null
                }
            },
            mounted() {
                this.loadActors();
                this.initActorPickerModal();
            },
            watch: {
                'movie.name': function () {
                    this.dirty = true;

                    // remove any error that may be present in the errors dictionary for name
                    this.errors.name = null;
                },

                search() {
                    this.updateActorSuggestions(this.search);
                }
            },
            computed: {
                clean() {
                    return !this.dirty
                },
                movieUrl() {
                    return '/api/movies/' + movie.id;
                }
            },
            methods: {

                addActorToCast() {
                    let url = route('movies.actors.store', {
                        movie: this.movie.id,
                        actor: this.selectedActor.id
                    });

                    window.axios.post(url).then(response => this.onActorAddedToCast(response))
                        .catch(error => console.log(error))
                        .then(() => console.log('done attempting to add actor'));
                },

                onActorAddedToCast(response) {
                    this.resetActorPickerModal();
                    this.actors.unshift(this.selectedActor);

                    // turn the highlight on
                    this.highlightedActor = this.selectedActor;

                    setTimeout(() => this.highlightedActor = null, 5000);
                },

                resetActorPickerModal() {
                    this.actorPicker.hide();
                    this.actorSuggestions = [];
                    this.search = '';
                },

                selectActor(actor) {
                    this.selectedActor = actor;
                },

                updateActorSuggestions() {

                    if (this.search.length == 0)
                        this.actorSuggestions = [];

                    if (this.search.length >= 1)
                        window.axios.get(route('actors.search', {
                            search: this.search
                        })).then(response => this.onActorSearchResult(response));
                },

                onActorSearchResult(response) {
                    this.actorSuggestions = response.data.data;
                },

                initActorPickerModal() {
                    this.actorPicker = new bootstrap.Modal(this.$refs.actorPicker);
                },

                popActorSelectModal() {
                    this.actorPicker.show();
                },

                loadActors() {
                    let url = route('movies.actors', this.movie.id);
                    window.axios.get(url).then(response => this.onActorsLoaded(response))
                        .catch(error => alert('Could not load actors'))
                        .then(() => console.log('Always callback'));

                },

                onActorsLoaded(response) {
                    this.actors = response.data.data;
                },

                save() {
                    this.busy = true;

                    // attempt to store this in the backend!
                    window.axios.put(this.movieUrl, this.movie).then((response) => this.onSaved(response))
                    .catch((error) => this.onError(error))
                    .then(() => this.busy = false);
                },

                popSavedToast() {
                    var toastLiveExample = document.getElementById('liveToast');
                    var toast = new bootstrap.Toast(toastLiveExample);
                    toast.show();
                },

                onSaved() {
                    this.popSavedToast();
                    this.dirty = false;
                },

                onError(error) {
                    this.errors = error.response.data.errors;
                }
            }
        })
    </script>
@endsection