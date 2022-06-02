<?php

namespace App\Http\Livewire;

use App\Models\Images;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class Image extends Component
{
    public $table = true,
        $createForm = false,
        $updateForm = false;
    public $files = [];
    public $new_files = [];
    public $edit_files = [];
    public $edit_id;
    public $old_files = [];

    use WithFileUploads;
    public function render()
    {
        $images = Images::all();
        return view('livewire.image', compact('images'))->layout('layout.app');
    }

    public function showForm()
    {
        $this->table = false;
        $this->createForm = true;
    }

    public function goBack()
    {
        $this->table = true;
        $this->createForm = false;
        $this->updateForm = false;
    }
    public function save()
    {
        $filename = [];
        $this->validate([
            'files.*' =>  'required'
        ]);

        if ($this->files != "") {
            foreach ($this->files as $file) {
                $filename[] = $file->store('post', 'public');
            }
        }

        $jdata = json_encode($filename);
        $images = new Images();
        $images->images = $jdata;
        $images->save();
        $this->table = true;
        $this->createForm = false;
        $this->files = [];
    }

    public function edit($id)
    {

        $this->table = false;
        $this->updateForm = true;

        $images = Images::find($id);
        $this->edit_files = $images->images;
        $this->old_files = $images->images;
        $this->edit_id = $images->id;
    }

    public function update($id)
    {
        $images = Images::find($id);
        $img = json_decode($images->images);
        $filenames = [];
        if ($this->new_files) {
            foreach ($img as $i) {
                $path = public_path('storage\\' . $i);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            foreach ($this->new_files as $file) {
                $filenames[] = $file->store('post', 'public');
            }
        }
        // dd('Above from jdata ' . $this->old_files);
        $jdata = $this->new_files  ? json_encode($filenames) : $this->old_files;
        $images->images = $jdata;
        $images->save();
        $this->table = true;
        $this->updateForm = false;
    }

    public function delete($id)
    {
        $images = Images::find($id);
        $img = json_decode($images->images);
        foreach ($img as $i) {
            $path = public_path('storage\\' . $i);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $images->delete();
    }
}
