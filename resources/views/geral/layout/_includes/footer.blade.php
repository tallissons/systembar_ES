</main>
    </body>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://customts.netlify.app/js/tsjss.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".button-collapse").sideNav();
            $(".dropdown-button").dropdown();
            @stack('ajax')
        });
    </script>

    @stack('js')

</html>
