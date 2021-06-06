<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moradores On-line</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">  
    <style>
        .front.row {
            margin-bottom: 40px;
        }

        @media all and (max-width:480px) {
        .custom-class { width: 100%; display:block; }
        }         

        body{
        background-image: url("{{asset('public/assets/img/background.jpg')}}");
        background-repeat: repeat;
        }

    </style>
    @yield('stylesheets')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 40px;">

    <a class="navbar-brand" href="{{route('inicial')}}">Moradores On-line</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(request()->is('/')) active @endif">
                <a class="nav-link" href="{{route('inicial')}}">Home <span class="sr-only">(current)</span></a>
            </li>

            @foreach($categories as $category)
                <li class="nav-item  @if(request()->is('category/' . $category->slug)) active @endif">
                    <a class="nav-link" href="{{route('category.single', ['slug' => $category->slug])}}">{{$category->name}}</a>
                </li>
            @endforeach
        </ul>

        <div class="my-2 my-lg-0">
            <ul class="navbar-nav mr-auto">

                @auth
                    <li class="nav-item  @if(request()->is('my-orders')) active @endif">
                        <a href="{{route('dweller.index')}}" class="nav-link">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault();
                                                                  document.querySelector('form.logout').submit(); ">Sair</a>

                        <form action="{{route('logout')}}" class="logout" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<div class="container">

    @include('flash::message')

    <div class="row">

        <div class="col-md-3 mb-5">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{route('user.edit', ['id' => $user->id])}} " class="btn btn-primary btn-block">Meus Dados</a></li>
                <li class="list-group-item"><a href="{{route('street.index')}}" class="btn btn-primary btn-block">Ruas</a></li>
                <li class="list-group-item"><a href="{{route('situation.index')}}" class="btn btn-primary btn-block">Situações</a></li>
                <li class="list-group-item"><a href="{{route('dweller.index')}}" class="btn btn-danger btn-block">Moradores</a></li>
                @if ($user->role == 'ROLE_OWNER')
                <li class="list-group-item"><a href="{{route('home')}}" class="btn btn-danger btn-block">Minha Loja</a></li>
                @endif
            </ul>    
        </div>

        <div class="col-md-9">
            @yield('content')
        </div>

    </div>

</div>

<style>

.footer {
  margin-top: 5rem;
  padding-top: 5rem;
  padding-bottom: 5rem;
  background-color: #2c3e50;
  color: #fff;
}

.copyright {
  background-color: #1a252f;
}

</style>

 <!-- Footer -->
 <footer class="footer text-center">
    <div class="container">
      <div class="row">

	  	  <!-- Footer Location -->
		<div class="col-lg-4 mb-5 mb-lg-0">
		<h4 class="text-uppercase mb-4">Localização</h4>
		<p class="lead mb-0">Bauru/SP
			<br/>Brasil</p>
		</div>

        <!-- Footer Social Icons -->
		<div class="col-lg-4 mb-5 mb-lg-0">
		<h4 class="text-uppercase mb-4">Redes Sociais</h4>
		<a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/brazilcats">
			<i class="fa fa-facebook-f"></i>
		</a> 
		<a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/brazilcats.com.br/">
			<i class="fa fa-instagram"></i>
		</a>
		<a class="btn btn-outline-light btn-social mx-1" href="https://twitter.com/brazilcats">
			<i class="fa fa-twitter"></i>
		</a>
		<a class="btn btn-outline-light btn-social mx-1" href="https://play.google.com/store/apps/developer?id=Brazilcats">
			<i class="fa fa-google"></i>
		</a>
		</div>

        <!-- Footer About Text -->
		<div class="col-lg-4">
		<h4 class="text-uppercase mb-4">Contato</h4>
		<p class="lead mb-0"><a href="https://api.whatsapp.com/send?phone=5514981473949&text=Olá gostaria de informações sobre"  rel="noopener noreferrer" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> (14) 98147-3949</a></p>
		</div>

      </div>
    </div>
  </footer>

  <!-- Copyright Section -->
  <section class="copyright py-4 text-center text-white">
    <div class="container">
      <small>Todos os direitos reservados &copy; APChoise 2020</small>
    </div>
  </section>

  <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
  <div class="scroll-to-top position-fixed ">
    <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
      <i class="fa fa-chevron-up"></i>
    </a>
  </div>



    
<script src="{{asset('public/js/app.js')}}"></script>
@yield('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    $('form[name="formdel"]').click(function(event)
	{    

		event.preventDefault();
        obj = $(this);

        swal({
            title: "Deseja realmente apagar o registro ?",
            text: "Depois de deletado, você não poderá recuperar esse registro novamente!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                obj.submit();
                //return true;
            } else {
                //swal("Your imaginary file is safe!");
            }
            });

	});  

	$(".btnproduto").click(function()
	{    
		event.preventDefault();
		obj = $(this).parent();
        cmp1 = obj.children().eq(1)[0].value;
        cmp2 = obj.children().eq(2)[0].value;
        cmp3 = obj.children().eq(3)[0].value;
        adicionarproduto($(this),cmp1,cmp2,cmp3);
	});                        

	function adicionarproduto(obj,cmp1,cmp2,cmp3)
					{

						$.ajax({
						type: "POST",
						url: "{{route('cart.add')}}",
						data: {'_token': '<?php echo csrf_token(); ?>', 'product[name]': cmp1, 'product[price]': cmp2, 'product[slug]': cmp3, 'product[amount]': 1},
						success: function(msg, status) 
						{
							obj.text('Adicionado ao Carrinho').attr("disabled", "disabled");
							
							swal({
							title: "Muito bem!",
							text: "Adicionado ao Carrinho!",
							type: "success",
							timer: 1000
							});

						},
						error: function(xhr, msg, e) {
							swal({
							title: "Erro!",
							text: "Ainda não!",
							type: "error",
							timer: 1000
							});
						}
						});
						
					}

    </script>
</body>
</html>