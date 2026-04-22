<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Models\PreRegistro;
use App\Models\Institucion;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Empresa;
use App\Models\Equipo;
use App\Models\Planes;
use App\Models\PlanesDetalle;
use App\Models\Actividad;
use App\Models\Ciudad;
use App\Models\CiudadesEmpresa;
use Exception;

use App\Http\Requests\RequestUsuarioCreate;

class controllerInicio extends Controller
{
    public function __construct()
    {
        if(!Session::has('datos'))
         {
         Session::put('datos',array());
         }
    }
    public function Inicio()
    {   
    	$empresas=Empresa::all();
        $visitas=Institucion::find(1);
        $n=$visitas->visitas+1;
        $visitas->fill([
            'visitas'=>$n,
        ])->save();
        $plan=Planes::first();
        $planDetalle=PlanesDetalle::all();
        $institucion=Institucion::first();
        $planes= Planes::all();
        $planesDetalle = PlanesDetalle::all();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();
        $countEmpresas=Empresa::count('id');
        $countUsers=User::count('id');
        return view('index',compact('planes','planesDetalle','categorias','institucion','plan','planDetalle','ciudades','countEmpresas','countUsers','empresas'));
    }
    public function detalleEmpresa($slug)
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();
        $actividad = Actividad::all();
        $empresa = Empresa::where('slug',$slug)->first();
        $nvisitas=Empresa::where('slug',$slug)->first();
        $n=$nvisitas->nvisitas+1;
        $nvisitas->fill([
            'nvisitas'=>$n,
        ])->save();

        return view('empresa-detalle',compact('empresa','categorias','institucion','ciudades'));
    }
    public function suscribir(Request $datos)
    {
        if(is_null($datos->email))
        {
            return redirect()->route('inicio');
        }else
        {
            Email::create([
                'email'=>$datos->email
            ]);
            $name = '/FaceBol.pptx';
            $path = base_path().'/public_html/imagen/'.$name;
            //$path = public_path('imagen').$name;
            $email = $datos->email;
            Mail::send('emails.emailPost',$datos->all(), function ($message) use ($path,$email) {
                $message->to($email,$email)
                ->subject('Acerca de Facebol');
                $message->attach($path);
            });
            return redirect()->route('inicio');
        }
    }
    public function emailPost(Request $datos)
    {
        $usuario=User::where('email',$datos->email)->first();
        if(!$usuario){
            Email::create([
                'email'=>$datos->email,
            ]);
        }
        Mail::send('emails.emailGet',$datos->all(),function($message) use($datos){
            $message->to('facebol@facebolsrl.com','Facebol')
            ->subject($datos->situacion);
        });
        return redirect()->route('inicio');
    }
    public function emailReset(Request $datos)
    {
        $usuario = User::where('email',$datos->email)->first();
        if($usuario)
        {
            $user=['nombre'=>$usuario->nombre,'email'=>$usuario->email,'codigo'=>$usuario->codigo];
            Mail::send('emails.emailReset',$user,function($message) use ($user){
                $message->to($user['email'],$user['nombre'])
                ->subject('Recuperacion de Contraseña');
            });
        }
        return redirect()->route('inicio');
    }
    public function passwordReset($dato)
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();
        $usuario=User::where('codigo',$dato)->first();
        if($usuario)
        {
            return view('inicio.reset.index',compact('dato','categorias','institucion','ciudades'));
        }else
        {
            return redirect()->route('inicio');
        }
    }
    public function newCodigo()
    {
        $codigo=str::random(25);
        $user=User::where('codigo',$codigo)->first();
        if($user)
        {
            $this->newCodigo();
        }else
        {
            return $codigo;
        }
    }
    public function passwordSave(Request $datos)
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();
        $usuario=User::where('codigo',$datos->codigo)->first();
        $usuario->fill(
            [
                'password'=>$datos->password,
                'codigo'=>$this->newCodigo(),
            ]
        );
        $usuario->save();
        Session::flash('title','Éxito al cambiar la contraseña');
        Session::flash('body','El cambio de contraseña fue un éxito, al identificarse nuevamente utilize  su nueva contraseña');
        return view('inicio.mensaje',compact('categorias','institucion','ciudades'));
    }
    public function preRegistro(Request $datos)
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();

        $usuario=User::where('cod_face',$datos->codigo)->first();
        if($usuario)
        {
        PreRegistro::create(
            [
                'nombre'=>$datos->nombre,
                'apellido'=>$datos->apellido,
                'email'=>$datos->email,
                'celular'=>$datos->celular,
                'usuario_id'=>$usuario->id,
                'imagen'=>$datos->imagen,
            ]);
            Session::flash('title','El Pre Registro fue un Éxito');
            Session::flash('body','Su pre registro fue un éxito, le mandamos un mensaje a su correo electrónico para mas información revíselo');
            return view('inicio.mensaje',compact('categorias','institucion','ciudades'));
        }else{
            Session::flash('title','El Pre Registro No Fue Realizado');
            Session::flash('body','No se pudo realizar el pre registro ya que el codigo de usuario no fue encontrado, por favor vuelva a realizar el registro y verifique el el codigo.');
            return view('inicio.mensaje',compact('categorias','institucion','ciudades'));
        }
    }
    public function contactanos()
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();

        return view('inicio.contacto',compact('institucion','categorias','categorias','ciudades'));
    }
    public function empresa()
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $empresas = Empresa::orderBy('prioridad','asc')->get();
        $ciudades=Ciudad::all();

        return view('empresas',compact('institucion','empresas','categorias','ciudades'));
    }
      public function comision()
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $empresas=Empresa::orderBy('prioridad','asc')->get();
        $ciudades=Ciudad::all();

        return view('inicio.comision',compact('institucion','empresas','categorias','ciudades'));
    }
       
  public function ciudad($id)
    {       
 try {
         $institucion=Institucion::first();
            $ciudad=CiudadesEmpresa::where('ciudad_id',$id)->first();
            $empresas=CiudadesEmpresa::all();

            $ci=Ciudad::where('id',$id)->first();
            $empresas1=Empresa::where('ciudad_id',$ci->id)->orderBy('prioridad','asc')->get();
            $categorias = Categoria::all();
            $ciudades=Ciudad::all();
    } catch (\Illuminate\Database\QueryException $e) {
        Alert::error('Ups!!!', 'No se encuentran empresas registradas en esta ciudad')->showConfirmButton('Ok',' #5bc0de');
            return Redirect::back();
    }
  return view('inicio.ciudades',compact('institucion','categorias','ciudad','empresas','ciudades','empresas1','ci'));
    
    
    
  
    }
    public function categoria($slug)
    {
        $institucion=Institucion::first();
        $categoria=Categoria::where('slug',$slug)->first();
        $empresas=Empresa::where('categoria_id',$categoria->id)->orderBy('prioridad','asc')->get();
        $categorias = Categoria::all();
        $ciudades=Ciudad::all();

        return view('inicio.categorias',compact('institucion','categorias','categoria','empresas','ciudades'));
    }
    public function mes($numero)
    {
        if($numero=='01')
        {
            return $mes="Enero";
        }else
        {
            if($numero=='02')
            {
                return $mes="Febrero";
            }else
            {
                if($numero=='03')
                {
                    return $mes="Marzo";
                }else
                {
                    if($numero=='04')
                    {
                        return $mes="Abril";
                    }else
                    {
                        if($numero=='05')
                        {
                            return $mes="Mayo";
                        }else
                        {
                            if($numero=='06')
                            {
                                $actividad["mes"]="Junio";
                            }else
                            {
                                if($numero=='07')
                                {
                                    $actividad["mes"]="Julio";
                                }else
                                {
                                    if($numero=='08')
                                    {
                                        return $mes="Agosto";
                                    }else
                                    {
                                        if($numero=='09')
                                        {
                                            return $mes="Septiembre";
                                        }else
                                        {
                                            if($numero=='10')
                                            {
                                                return $mes="Octubre";
                                            }else
                                            {
                                                if($numero=='11')
                                                {
                                                    return $mes="Noviembre";
                                                }else
                                                {
                                                    if($numero=='12')
                                                    {
                                                        return $mes="Diciembre";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function actividad()
    {
        $actividades=Actividad::orderBy('id','desc')->get();
        foreach($actividades as $actividad)
        {
            list($año,$mes,$dia)=explode("-",$actividad->fecha);
            $actividad["dia"]=$dia;
            $actividad["mes"]=$this->mes($mes);
            $actividad["año"]=$año;
        }
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $actividad = Actividad::all();
        $ciudades=Ciudad::all();

        return view('inicio.actividades',compact('institucion','actividad','categorias','actividades','ciudades'));
    }
    public function equipo()
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $equipos1 = Equipo::where('estado', 1)->get();
        $ciudades=Ciudad::all();
        return view('inicio.equipo',compact('institucion','equipos1','categorias','ciudades'));
    }
    public function noticia()
    {
        $actividades=Actividad::orderBy('id','desc')->get();
        foreach($actividades as $actividad)
        {
            list($año,$mes,$dia)=explode("-",$actividad->fecha);
            $actividad["dia"]=$dia;
            $actividad["mes"]=$this->mes($mes);
            $actividad["año"]=$año;
        }
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $actividad = Actividad::all();
        $ciudades=Ciudad::all();

        return view('inicio.noticias',compact('institucion','actividad','categorias','actividades','ciudades'));
    }
    public function registroUsuario($codigo)
    {
        $ciudades=Ciudad::orderBy('id','desc')->pluck('nombre','id');
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();
        $ciudadselect=Ciudad::orderBy('id','desc')->pluck('nombre','id');
        $id=decrypt($codigo);
        $preRegistro=PreRegistro::where('id',$id)->first();
        if($preRegistro->activo=='2')
        {
            Session::flash('title','Error de solicitud de Registro');
            Session::flash('body','No puede realizar el registro por motivos de ya haberlo realizado o no estar habilitado para el mismo. Contactase con administración para mas información');
            return view('inicio.mensaje-error',compact('categorias','institucion','ciudades','ciudadselect'));
        }else
        {
            if($preRegistro->activo=='1')
            {
                Session::flash('title','Error de solicitud de Registro');
                Session::flash('body','No puede realizar el registro por motivos de ya haberlo realizado o no estar habilitado para el mismo. Contactase con administración para mas información');
                return view('inicio.mensaje-error',compact('categorias','institucion'.'ciudades','ciudadselect'));
            }else
            {
             if($preRegistro->activo=='0')
                {
                    return view('inicio.registrar',compact('codigo','institucion','categorias','ciudades','ciudadselect'));
                }
            }
        }
    }
    public function codigo()
    {
        $codigo=str::random(20);
        $usuario=User::where('codigo',$codigo)->first();
        if($usuario)
        {
            $this->codigo();
        }else{
            return $codigo;
        }
    }
    public function crearUsuario(RequestUsuarioCreate $request, $codigo)
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();

        $id=decrypt($codigo);

        $pre=PreRegistro::where('id',$id)->first();
        User::create([
            'ciudad_id'=>$request->ciudad_id,
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'ci'=>$request->ci,
            'direccion'=>$request->direccion,
            'celular'=>$pre->celular,
            'email'=>$pre->email,
            'password'=>$request->password,
            'imagen'=>$request->imagen,
            'codigo'=>$this->codigo(),
            'tipo'=>'Usuario',
            'activo'=>1,
            'cod_face'=>$request->ci."FB",
        ]);
        $ci=encrypt($request->ci);

        return view('inicio.codigo',compact('institucion','categorias','ci','ciudades'));
    }
    public function codigoUsuario(Request $request,$ci)
    {
        $institucion=Institucion::first();
        $categorias=Categoria::all();
        $ciudades=Ciudad::all();

        $user=User::where('ci',decrypt($ci))->first();
        if($request->cod_face==null)
        {
            $pre=PreRegistro::where('email',$user->email)->first();
            $pre->fill([
                'activo'=>2,
            ]);
            $pre->save();
            Session::flash('title','Registro Exitoso');
            Session::flash('body','Cuenta registrada exitosamente, ahora puede ingresar a su panel de control en el login de la pagina');
            return view('inicio.mensaje',compact('institucion','categorias','ciudades'));
        }else
        {
            $lider=User::where('cod_face',$request->cod_face)->first();
            if($lider)
            {
                $user->fill([
                    'user_id'=>$lider->id
                ]);
                $user->save();
                $pre=PreRegistro::where('email',$user->email)->first();
                $pre->fill([
                    'activo'=>2,
                ]);
                $pre->save();

                Session::flash('title','Registro Exitoso');
                Session::flash('body','Cuenta registrada exitosamente, ahora puede ingresar a su panel de control en el login de la pagina');
                return view('inicio.mensaje',compact('institucion','categorias','ciudades'));
            }else
            {
                Session::flash('error','El codigo usuario no fue encontrado, vuelva a intentarlo');
                return view('inicio.codigo',compact('institucion','categorias','ci','ciudades'));
            }
        }

    }
}