<div>
    @if ($table == true)
        <div class="card my-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <button wire:click='showForm' class="btn btn-success">
                        <span wire:loading.remove wire:target='showForm'>Create</span>
                        <span wire:loading wire:target='showForm'>
                            <span class="spinner-border spinner-border-sm " style="margin-right:9px;" role="status"
                                aria-hidden="true"></span>Loading...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($table == true)
        <div wire:loading class="text-center">
            <div>
                <div class="spinner-border" role="status"></div>
            </div>
        </div>
        @foreach ($images as $image)
            <div class="swiper mySwiper my-5">
                <button wire:click="delete({{ $image->id }})" class="btn btn-danger">Delete</button>
                <button wire:click='edit({{ $image->id }})' class="btn btn-primary">Edit</button>
                <div class="swiper-wrapper my-2">
                    @foreach (json_decode($image->images) as $item)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage\\') . $item }}"
                                style="width:100%;height:60vh;object-fit:cover;" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        @endforeach

    @endif

    @if ($createForm == true)
        <div wire:loading class="text-center">
            <div>
                <div class="spinner-border" role="status"></div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-md-8 col-sm-12">
                <div class="my-3">
                    <button class="btn btn-danger" wire:click='goBack'>
                        <span wire:loading.remove wire:target='goBack'>Go Back</span>
                        <span wire:loading wire:target='goBack'>
                            <span class="spinner-border spinner-border-sm " style="margin-right:9px;" role="status"
                                aria-hidden="true"></span>Loading...
                        </span>
                    </button>
                </div>
                <form action="" wire:submit.prevent="save">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Files</label>
                        <input class="form-control" wire:model="files" multiple type="file" id="formFile">

                        @error('files.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-danger" type="submits">
                            <span wire:loading.remove wire:target='save'>Save</span>
                            <span wire:loading wire:target='save'>
                                <span class="spinner-border spinner-border-sm " style="margin-right:9px;" role="status"
                                    aria-hidden="true"></span>Loading...
                            </span>
                        </button>
                    </div>
                    <div class="mb-3">
                        @if ($files)
                            @foreach ($files as $file)
                                <img src="{{ $file->temporaryUrl() }}" style="width:80px;height:80px" alt="">
                            @endforeach
                        @endif
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($updateForm == true)
        <div wire:loading class="text-center">
            <div>
                <div class="spinner-border" role="status"></div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-6 col-md-8 col-sm-12">
                <div class="my-3">
                    <button class="btn btn-danger" wire:click='goBack'>
                        <span wire:loading.remove wire:target='goBack'>Go Back</span>
                        <span wire:loading wire:target='goBack'>
                            <span class="spinner-border spinner-border-sm " style="margin-right:9px;" role="status"
                                aria-hidden="true"></span>Loading...
                        </span>
                    </button>
                </div>
                <form action="" wire:submit.prevent="update({{ $edit_id }})">
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Upload Files</label>
                        <input class="form-control" wire:model="new_files" multiple type="file" id="formFile">
                        @error('new_files.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-danger" type="submits">
                            <span wire:loading.remove wire:target='save'>Save</span>
                            <span wire:loading wire:target='save'>
                                <span class="spinner-border spinner-border-sm " style="margin-right:9px;" role="status"
                                    aria-hidden="true"></span>Loading...
                            </span>
                        </button>
                    </div>

                    <input type="text" wire:model="old_files">
                    <div class="mb-3">
                        @if ($new_files)
                            @foreach ($new_files as $file)
                                <img src="{{ $file->temporaryUrl() }}" style="width:80px;height:80px" alt="">
                            @endforeach
                        @else
                            @foreach (json_decode($edit_files) as $item)
                                <img src="{{ asset('storage\\') }}/{{ $item }}" style="width:70px;height:70px"
                                    alt="">
                            @endforeach
                        @endif
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
