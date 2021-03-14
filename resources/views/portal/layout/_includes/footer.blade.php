</main>
    </body>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="https://customts.netlify.app/js/tsjss.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".button-collapse").sideNav();
            @stack('ajax')

            $('.name').text('{{auth()->user()->nome}}');
            $('.email').text('{{auth()->user()->email}}');
        });
    </script>

    @stack('js')

</html>
