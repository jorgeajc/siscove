@component('mail::layout')
    {{-- Header --}}
    @slot('header') 
        @component('mail::header', ['url' => config('#')])
            <?php echo e("SISCOVE"); ?>
            <br>
            <?php echo e("Sistema de Control Vehicular"); ?>
        @endcomponent
    @endslot

    {{-- Body ![]({{base64_encode(file_get_contents(resource_path('/views/vendor/mail/html/logo.png')))}})--}}
    {{ $slot }}   
    
    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')

                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
        <div class="footer-copyright text-center py-3" align="center">© 2019 Copyright:
            <a href="/"> <?php echo e("SISCOVE"); ?></a>
        </div> 
        @endcomponent
    @endslot
@endcomponent
