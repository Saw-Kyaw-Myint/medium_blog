@extends('template.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
@section('header')
    @extends('template.login_nav')
@endsection

@section('content')
    <div class="container">
        <div class="post-whole">
            <h2>Post Create</h2>
            <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="post-title">
                    <input type="text" name="title" placeholder="Post Title" value="{{ old('title',$post->title) }}">
                    @error('title')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="category">
                    <div class="multiSelect">
                        <select multiple name="category[]" class="multiSelect_field" data-placeholder="Select Category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category[].*') == $category->id ? 'selected' : ' ' }}>{{ $category->ctitle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                        <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="iconX">
                            <g stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </g>
                        </symbol>
                    </svg>

                    @error('category')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <div class="file">
                    <input type="file" name="image" value="{{ old('image',$post->image) }}" onchange="loadFile(event)">
                    @error('image')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    <img id="output" alt="preview" src="{{ asset('storage/'.$post->image) }}">
                </div>
                <div class="description">
                    <textarea id="summernote" name="description">{{ old('description',strip_tags(html_entity_decode($post->description))) }}</textarea>
                    @error('description')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <button type="submit" class="publish">Publish</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var loadFile = function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('output');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
        $('#summernote').summernote({
            placeholder: 'Post Description',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        jQuery(function() {
            jQuery('.multiSelect').each(function(e) {
                var self = jQuery(this);
                var field = self.find('.multiSelect_field');
                var fieldOption = field.find('option');
                var placeholder = field.attr('data-placeholder');

                field.hide().after(`<div class="multiSelect_dropdown"></div>
                              <span class="multiSelect_placeholder">` + placeholder + `</span>
                              <ul class="multiSelect_list"></ul>
                              <span class="multiSelect_arrow"></span>`);

                fieldOption.each(function(e) {
                    jQuery('.multiSelect_list').append(
                        `<li class="multiSelect_option" data-value="` + jQuery(this).val() + `">
                                                  <a class="multiSelect_text">` + jQuery(this).text() + `</a>
                                                </li>`);
                });

                var dropdown = self.find('.multiSelect_dropdown');
                var list = self.find('.multiSelect_list');
                var option = self.find('.multiSelect_option');
                var optionText = self.find('.multiSelect_text');

                dropdown.attr('data-multiple', 'true');
                list.css('top', dropdown.height() + 5);

                option.click(function(e) {
                    var self = jQuery(this);
                    e.stopPropagation();
                    self.addClass('-selected');
                    field.find('option:contains(' + self.children().text() + ')').prop('selected',
                        true);
                    dropdown.append(function(e) {
                        return jQuery('<span class="multiSelect_choice">' + self.children()
                            .text() +
                            '<svg class="multiSelect_deselect -iconX"><use href="#iconX"></use></svg></span>'
                            ).click(function(e) {
                            var self = jQuery(this);
                            e.stopPropagation();
                            self.remove();
                            list.find('.multiSelect_option:contains(' + self
                            .text() + ')').removeClass('-selected');
                            list.css('top', dropdown.height() + 5).find(
                                '.multiSelect_noselections').remove();
                            field.find('option:contains(' + self.text() + ')').prop(
                                'selected', false);
                            if (dropdown.children(':visible').length === 0) {
                                dropdown.removeClass('-hasValue');
                            }
                        });
                    }).addClass('-hasValue');
                    list.css('top', dropdown.height() + 5);
                    if (!option.not('.-selected').length) {
                        list.append('<h5 class="multiSelect_noselections">No Selections</h5>');
                    }
                });

                dropdown.click(function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    dropdown.toggleClass('-open');
                    list.toggleClass('-open').scrollTop(0).css('top', dropdown.height() + 5);
                });

                jQuery(document).on('click touch', function(e) {
                    if (dropdown.hasClass('-open')) {
                        dropdown.toggleClass('-open');
                        list.removeClass('-open');
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('css/login/js/login_nav.js') }}"></script>
@endpush
