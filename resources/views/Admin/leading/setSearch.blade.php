<script>
    $(function() {
        let Search = JSON.parse('<?php echo $Search ?? json_encode([]); ?>');
        for (let key in Search) {
            $(`#${key}`).val(Search[key]);
        }
    });

    function SearchClear() {
        document.location.href = "?";
    }
</script>
