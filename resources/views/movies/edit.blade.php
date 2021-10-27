@extends('layouts.main')

@section('content')

    <div id="movies-edit-app">
        <h2>Editing movie</h2>

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
                    errors: {}
                }
            },
            watch: {
                'movie.name': function () {
                    this.dirty = true;

                    // remove any error that may be present in the errors dictionary for name
                    this.errors.name = null;
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