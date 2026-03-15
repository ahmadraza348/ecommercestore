<div class="card mt-4">
    <div class="card-body">
    
        <div class="row g-4">
            <!-- Meta Title -->
            <div class="col-lg-6 col-sm-12">
                <div class="form-group mb-0">
                    <label class="form-label" for="meta_title">Meta Title</label>
                    <div class="form-control-wrap">
                        <input type="text" name="meta_title" id="meta_title" class="form-control"
                            value="{{ old('meta_title') }}">
                        <div class="text-danger">
                            @error('meta_title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meta Keywords -->
            <div class="col-lg-6 col-sm-12">
                <div class="form-group mb-0">
                    <label class="form-label" for="meta_keywords">Meta Keywords</label>
                    <div class="form-control-wrap">
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            class="form-control" value="{{ old('meta_keywords') }}">
                        <div class="text-danger">
                            @error('meta_keywords')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Meta Description -->
            <div class="col-lg-12">
                <div class="form-group mb-0">
                    <label class="form-label" for="meta_description">Meta Description</label>
                    <div class="form-control-wrap">
                        <textarea name="meta_description" class="form-control" id="meta_description" cols="30" rows="4">{{ old('meta_description') }}</textarea>
                        <div class="text-danger">
                            @error('meta_description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
