<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?> "></script>
<script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
<script>
    function closeScript() {
        setTimeout(function () {
            window.open(window.location, '_self').close();
        }, 1000);
    }

    $(window).on('load', function () {
        var element = document.getElementById('boxes');
        var opt = {
            filename: '<?php echo e(Utility::customerInvoiceNumberFormat($invoice->invoice_id)); ?>',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };
        html2pdf().set(opt).from(element).save().then(closeScript);
    });

</script>
<?php /**PATH /home3/amarcmar/public_html/crm/resources/views/invoice/script.blade.php ENDPATH**/ ?>