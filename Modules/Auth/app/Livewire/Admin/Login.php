<?php
namespace Modules\Auth\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Modules\Auth\Http\Requests\Admin\loginRequest;
class Login extends Component
{
    public $username,$password;
    public function login(){    
        $this->validate();
        if(Auth::attempt(["username"=>$this->username,"password"=>$this->password],true)){
            request()->session()->regenerate();
        }
        return redirect()->route("admin.dashboard");
    }
    protected function rules(){
        return (new loginRequest())->rules();
    }
    public function render()
    {
        return view('auth::livewire.admin.login');
    }
}
