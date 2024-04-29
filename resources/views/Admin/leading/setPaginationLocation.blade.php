<script>
    $(function() {
        $('#__Pagination').css({"position": "fixed", "left": "calc(50% - 108px)", "bottom": "-0.5em"});
        let Search = JSON.parse('<?php echo $Search ?? json_encode([]); ?>');
        let HttpBuildQuery = '';
        for (let key in Search) {
            HttpBuildQuery += `&${key}=${Search[key]}`;
        }
        $('.pagination .page-item a').each(function(index) {
            $(this).attr('href', ($(this).attr('href') + HttpBuildQuery));
        });
    });
</script>
