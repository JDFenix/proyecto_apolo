@section('footer')
    <style>
        .texto-azul {
            font-style: Segoe UI;
            color: #022D74;
        }

        .p {
            Color: #000000
        }
    </style>
    <div class="container-fluid">

        <div class="row p-5 pb-2 bg-white texto-azul">

            <div class="col-xs-12 col-md-6 col-lg-3">
                <img src="{{ asset('images/logo_universidad.png') }}" class="mb-2" width="160px" height="80px"
                    src="./images/Logo horizontal.png" alt="Logo">
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <p class="h5 mb-4">Contáctanos</p>
                <div class="mb-2">
                    <p class="bi bi-geo-alt-fill"><a class="text-secondary text-decoration-none"
                            href="https://www.google.com/maps/place/Universidad+Politecnica+de+Tecamac/@19.7141488,-98.9807546,17z/data=!3m1!4b1!4m6!3m5!1s0x85d1ed2fa5d3a6c1:0x1f383377175dc58a!8m2!3d19.7141438!4d-98.9781797!16s%2Fg%2F1q69rxsk0?entry=ttu">
                            Av. 5 de mayo, Tecámac Estado de México</a>
                        <p />
                </div>
                <div class="mb-2">
                    <p class="bi bi-telephone-fill"> <a class="text-secondary text-decoration-none" href="tel:+55235235634">
                            55235235634</a></p>
                </div>
                <div class="mb-2">
                    <p class="bi bi-envelope-fill"><a class="text-secondary text-decoration-none"
                            href="https://mail.google.com/mail/?view=cm&fs=1&to=universidad@gmail.com">
                            universidad@gmail.com</a></p>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <p class="h5 mb-4">¿Nececitas ayuda?</p>
                <div class="mb-2">
                    <p class="bi bi-info-circle-fill"><a class="text-secondary text-decoration-none"
                            href="{{ route('user.contact') }}"> Da
                            click aquí</a></p>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-3">
                <p class="h5 mb-4">Síguenos</p>
                <div class="mb-2">
                    <p class="bi bi-facebook"><a class="text-secondary text-decoration-none"
                            href="https://www.facebook.com/"> Universidad Politécnica</a>
                    </p>
                </div>
                <div class="mb-2">
                    <p class="bi bi-instagram"><a class="text-secondary text-decoration-none"
                            href="https://www.instagram.com/"> @laU_Politécnica</a>
                    </p>
                </div>
            </div>

            <div class="col-xs-12 pt-3 border-top">
                <p class="texto-azul text-center">Copyright - All rights reserved © 2024</p>
            </div>
        </div>
    </div>
@endsection
