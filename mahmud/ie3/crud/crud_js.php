<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function isNumeric(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if ((charCode > 31) && (charCode != 46) && (charCode < 48 || charCode > 57)) {
            return false;
        }

        return true;
    }

    $(document).ready(function () {

        $(document).on('keyup change', '.salary_part', function () {
            var Total = 0;
            var Part = 0;
            $('.salary_part').each(function () {
                Part = $(this).val();
                if (Part == '') {
                    Part = 0;
                }
                Total += parseFloat(Part);
            });

            $('.gross_salary').val(Total);
        });
    });
</script>