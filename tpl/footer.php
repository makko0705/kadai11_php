<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
    <script>
        $('#btn_menu').click(function() {
            $('.menu').fadeIn(500);
            console.log('おしました');
            $('#btn_menu').hide();
        });
        $('#btn_close').click(function() {
            $('.menu').fadeOut(500);
            console.log('とじるをおしました');
            $('#btn_menu').fadeIn(500);
        });
</script>
