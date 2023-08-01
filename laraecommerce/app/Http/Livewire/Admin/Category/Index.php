<?php

namespace App\Http\Livewire\Admin\Category;
use App\Models\Category;
// use Faker\Core\File;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public $category_id;

    public function deleteCategorry($category_id)
    {
        // dd($category_id);
        $this->category_id = $category_id;
    }

    public function destroyCategoy()
    {
        //dd('submit');
        $category = Category::find($this->category_id);
        $path = 'uploads/category/'.$category->image;
        if(File::exists($path)){
            File::delete($path);
        }
        $category->delete();
        session()->flash('message','category deleted ');
        $this->dispatchBrowserEvent('close-modal');
    }


    public function render()
    {
        
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.category.index',['categories'=>$categories]);
    }

   
}
