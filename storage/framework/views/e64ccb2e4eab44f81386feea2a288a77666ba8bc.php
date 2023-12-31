<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Invoice Edit')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Invoice')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.repeater.min.js')); ?>"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            var $dragAndDrop = $("body .repeater tbody").sortable({
                handle: '.sort-handler'
            });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: true,
                defaultValues: {
                    'status': 1
                },
                show: function () {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    if($('.select2').length) {
                        $('.select2').select2();
                    }
                },
                hide: function (deleteElement) {


                    $(this).slideUp(deleteElement);
                    $(this).remove();
                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));
                    $('.totalAmount').html(subTotal.toFixed(2));

                },
                ready: function (setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');

            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                    
                    tr.find('.prod_store').val(value[i].store_id);
                    changeStore(tr.find('.prod_store'));
                  
                }
            }

        }

        $(document).on('change', '#customer', function () {
            $('#customer_detail').removeClass('d-none');
            $('#customer_detail').addClass('d-block');
            $('#customer-box').removeClass('d-block');
            $('#customer-box').addClass('d-none');
            var id = $(this).val();
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'id': id
                },
                cache: false,
                success: function (data) {
                    if (data != '') {
                        $('#customer_detail').html(data);
                    } else {
                        $('#customer-box').removeClass('d-none');
                        $('#customer-box').addClass('d-block');
                        $('#customer_detail').removeClass('d-block');
                        $('#customer_detail').addClass('d-none');
                    }
                },

            });
        });

        $(document).on('click', '#remove', function () {
            $('#customer-box').removeClass('d-none');
            $('#customer-box').addClass('d-block');
            $('#customer_detail').removeClass('d-block');
            $('#customer_detail').addClass('d-none');
        })
     
        $(document).on('change', '.item', function () {
            changeItem($(this));
        });

        var invoice_id = '<?php echo e($invoice->id); ?>';

        function changeItem(element) {


            var iteams_id = element.val();


            var url = element.data('url');
            var el = element;
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'product_id': iteams_id
                },
                cache: false,
                success: function (data) {
                    var item = JSON.parse(data);

                    $.ajax({
                        url: '<?php echo e(route('invoice.items')); ?>',
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': jQuery('#token').val()
                        },
                        data: {
                            'invoice_id': invoice_id,
                            'product_id': iteams_id,
                        },
                        cache: false,
                        success: function (data) {
                            var invoiceItems = JSON.parse(data);


                            if (invoiceItems != null) {


                                var amount = (invoiceItems.price * invoiceItems.quantity);
                                var thplamount = (invoiceItems.boxcost * invoiceItems.boxno);

                                $(el.parent().parent().find('.quantity')).val(invoiceItems.quantity);
                                $(el.parent().parent().find('.price')).val(invoiceItems.price);
                                $('.pro_description').val('3PL');
                                $('.boxno').val(invoiceItems.boxno);
                                $('.boxcost').val(invoiceItems.boxcost);
                                $('.thplamount').text(thplamount);

                            } else {
                                $(el.parent().parent().find('.quantity')).val(1);
                                $(el.parent().parent().find('.price')).val(item.product.sale_price);
                                $(el.parent().parent().find('.discount')).val(0);
                                $(el.parent().parent().find('.pro_description')).val(item.product.sale_price);
                                $('.pro_description').text(item.product.sale_price);

                            }


                            var taxes = '';
                            var tax = [];

                            var totalItemTaxRate = 0;
                            for (var i = 0; i < item.taxes.length; i++) {
                                taxes += '<span class="badge bg-primary p-2 px-3 rounded mt-1 mr-1">' + item.taxes[i].name + ' ' + '(' + item.taxes[i].rate + '%)' + '</span>';
                                tax.push(item.taxes[i].id);
                                totalItemTaxRate += parseFloat(item.taxes[i].rate);
                            }

                            if (invoiceItems != null) {
                                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (invoiceItems.price * invoiceItems.quantity));
                            } else {
                                var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (item.product.sale_price * 1));
                            }

                            $(el.parent().parent().find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));
                            $(el.parent().parent().find('.itemTaxRate')).val(totalItemTaxRate.toFixed(2));
                            $(el.parent().parent().find('.taxes')).html(taxes);
                            $(el.parent().parent().find('.tax')).val(tax);
                            $(el.parent().parent().find('.unit')).html(item.unit);


                            if (invoiceItems != null) {
                                $(el.parent().parent().find('.amount')).html(amount);
                            } else {
                                $(el.parent().parent().find('.amount')).html(item.totalAmount);
                            }

                            var inputs = $(".amount");
                            var inputtwo = $(".thplamount");
                            var subTotal = 0;
                            var fees = 0;
                            var fee = 0;
                            for (var i = 0; i < inputs.length; i++) {
                                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html())+  parseFloat($(inputtwo[i]).html());
                            }
                            
                            var percent = 2.95 / 100;
                            fees = parseFloat(subTotal) * percent;
                            fee = parseFloat(fees.toFixed(2));

                            $('.totalTax').html(fee.toFixed(2));
                            $('.subTotal').html(subTotal.toFixed(2));

                            var totalItemDiscountPrice = 0;
                            var itemDiscountPriceInput = $('.discount');

                            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
                            }


                            var totalItemPrice = 0;
                            var priceInput = $('.price');
                            for (var j = 0; j < priceInput.length; j++) {
                                totalItemPrice += parseFloat(priceInput[j].value);
                            }

                            var totalItemTaxPrice = 0;
                            var itemTaxPriceInput = $('.itemTaxPrice');
                            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
                            }

                           

                            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice) ));
                            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));

                        }
                    });


                },
            });
        }

        $(document).on('change', '.prod_store', function () {
            changeStore($(this));
        });
   
        function changeStore(element) {
            var invoicee_id = '<?php echo e($invoice->id); ?>';
            var prod_id = $('.item').val();
            var storee_id = element.val();
            var el = element;
            var store;
            $.ajax({
                url: '/invoice/stores',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': jQuery('#token').val()
                },
                data: {
                    'store_id': storee_id,
                    'invoicee_id': invoicee_id,
                    'product_id': prod_id,
                },
                cache: false,
                success: function (data) {
                    store = JSON.parse(data);
                    console.log(store);
                    $('.storename').text(store.storenam);
                    $('.blnce').text(store.blnce);
                },
                complete: function (data) {
                   
                    getbudget(store.totalamount); 
                }
            });
        }

    function getbudget(totalamount){
        var storebudget = $('.blnce').text();
        var totalAmount = totalamount;
            var totalvalu = parseFloat(storebudget) - parseFloat(totalAmount) ;
            var totalvalue= Math.round(totalvalu);
            if(totalvalue > 0 || totalvalue == 0){
                $('.budget').text(totalvalue);
                $('.newbudget').val(totalvalue);
                $('.expense').val(totalAmount);
            }else{
                $('.budget').text('Budget is-not enough');
                $('.newbudget').val('Budget is-not enough');
                $('.expense').val(totalAmount);
            }
    }
    function getbudgett(){
        var storebudget = $('.blnce').text();
        var totalAmount = $('.totalAmount').text();
            var totalvalu = parseFloat(storebudget) - parseFloat(totalAmount) ;
            var totalvalue= Math.round(totalvalu);
            if(totalvalue > 0 || totalvalue == 0){
                $('.budget').text(totalvalue);
                $('.newbudget').val(totalvalue);
                $('.expense').val(totalAmount);
            }else{
                $('.budget').text('Budget is-not enough');
                $('.newbudget').val('Budget is-not enough');
                $('.expense').val(totalAmount);
            }
    }
        $(document).on('keyup', '.quantity', function () {
            var quntityTotalTaxPrice = 0;
            var totalAmount = $('.totalAmount').text();
            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.price')).val();
            var discount = $(el.find('.discount')).val();

            var totalItemPrice = (quantity * price);
            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".amount");
            var inputtwo = $(".thplamount");
            var subTotal = 0;
            var fees = 0;
            var fee = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html())+ parseFloat($(inputtwo[i]).html());
            }
            var percent = 2.95 / 100;
            fees = parseFloat(subTotal) * percent;
            fee = parseFloat(fees.toFixed(2));

            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalTax').html(fee.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));
            getbudgett();
        })

        $(document).on('keyup', '.boxno', function () {
            var quntityTotalTaxPrice = 0;

            var el = $(this).parent().parent().parent().parent();
            var quantity = $(this).val();
            var price = $(el.find('.boxcost')).val();
            var discount = $(el.find('.discount')).val();

            var totalItemPrice = (quantity * price);
            var amount = (totalItemPrice);
            $(el.find('.thplamount')).html(amount);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".thplamount"); 
            var inputtwo = $(".amount");
            var subTotal = 0;
            var fees = 0;
            var fee = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html()) + parseFloat($(inputtwo[i]).html());
            }
            $('.subTotal').html(subTotal.toFixed(2));
            var percent = 2.95 / 100;
            fees = parseFloat(subTotal) * percent;
            fee = parseFloat(fees.toFixed(2));
            $('.totalTax').html(fee.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice) ).toFixed(2));
            getbudgett();
        })

        $(document).on('keyup', '.price', function () {

            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.quantity')).val();
            var discount = $(el.find('.discount')).val();
            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".amount");
            var inputtwo = $(".thplamount");
            var subTotal = 0;
            var fees = 0;
            var fee = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html())+ parseFloat($(inputtwo[i]).html());
            }
            $('.subTotal').html(subTotal.toFixed(2));
            var percent = 2.95 / 100;
            fees = parseFloat(subTotal) * percent;
            fee = parseFloat(fees.toFixed(2));
            $('.totalTax').html(fee.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice)).toFixed(2));
            getbudgett();
        })

        $(document).on('keyup', '.boxcost', function () {
            var el = $(this).parent().parent().parent().parent();
            var price = $(this).val();
            var quantity = $(el.find('.boxno')).val();
            var discount = $(el.find('.discount')).val();
            var totalItemPrice = (quantity * price);

            var amount = (totalItemPrice);
            $(el.find('.thplamount')).html(amount);


            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var inputs = $(".amount");
            var inputtwo = $(".thplamount");
            var subTotal = 0;
            var fees = 0;
            var fee = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html())+ parseFloat($(inputtwo[i]).html());
            }
            $('.subTotal').html(subTotal.toFixed(2));

            var percent = 2.95 / 100;
            fees = parseFloat(subTotal) * percent;
            fee = parseFloat(fees.toFixed(2));
            $('.totalTax').html(fee.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) + parseFloat(totalItemTaxPrice) ).toFixed(2));
            getbudgett();
        })
      

        $(document).on('keyup', '.discount', function () {
            var el = $(this).parent().parent().parent().parent();
            var discount = $(this).val();
            var price = $(el.find('.price')).val();

            var quantity = $(el.find('.quantity')).val();
            var totalItemPrice = (quantity * price);

            var totalItemTaxRate = $(el.find('.itemTaxRate')).val();
            var itemTaxPrice = parseFloat((totalItemTaxRate / 100) * (totalItemPrice));
            $(el.find('.itemTaxPrice')).val(itemTaxPrice.toFixed(2));


            var totalItemTaxPrice = 0;
            var itemTaxPriceInput = $('.itemTaxPrice');
            for (var j = 0; j < itemTaxPriceInput.length; j++) {
                totalItemTaxPrice += parseFloat(itemTaxPriceInput[j].value);
            }


            var totalItemDiscountPrice = 0;
            var itemDiscountPriceInput = $('.discount');

            for (var k = 0; k < itemDiscountPriceInput.length; k++) {

                totalItemDiscountPrice += parseFloat(itemDiscountPriceInput[k].value);
            }

            var amount = (totalItemPrice);
            $(el.find('.amount')).html(amount);

            var inputs = $(".amount");
            var subTotal = 0;
            for (var i = 0; i < inputs.length; i++) {
                subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
            }
            $('.subTotal').html(subTotal.toFixed(2));
            $('.totalDiscount').html(totalItemDiscountPrice.toFixed(2));
            $('.totalTax').html(totalItemTaxPrice.toFixed(2));

            $('.totalAmount').html((parseFloat(subTotal) - parseFloat(totalItemDiscountPrice) + parseFloat(totalItemTaxPrice)).toFixed(2));
        })

        $(document).on('click', '[data-repeater-create]', function () {
            $('.item :selected').each(function () {
                var id = $(this).val();
                $(".item option[value=" + id + "]").prop("disabled", true);
            });
        })

        $('.delete_item').click(function () {
            if (confirm('Are you sure you want to delete this element?')) {
                var el = $(this).parent().parent();
                var id = $(el.find('.id')).val();

                $.ajax({
                    url: '<?php echo e(route('invoice.product.destroy')); ?>',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': jQuery('#token').val()
                    },
                    data: {
                        'id': id
                    },
                    cache: false,
                    success: function (data) {

                    },
                });

            }
        });

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    
    <div class="row">
        <?php echo e(Form::model($invoice, array('route' => array('invoice.update', $invoice->id), 'method' => 'PUT','class'=>'w-100'))); ?>

        <div class="col-12">
            <input type="hidden" name="_token" id="token" value="<?php echo e(csrf_token()); ?>">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" id="customer-box">
                                <?php echo e(Form::label('customer_id', __('Customer'),['class'=>'form-label'])); ?>

                                <?php echo e(Form::select('customer_id', $customers,null, array('class' => 'form-control select ','id'=>'customer','data-url'=>route('invoice.customer'),'required'=>'required'))); ?>

                            </div>
                            <div id="customer_detail" class="d-none">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('issue_date', __('Issue Date'),['class'=>'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <?php echo e(Form::date('issue_date',null,array('class'=>'form-control','required'=>'required'))); ?>



                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('due_date', __('Due Date'),['class'=>'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <?php echo e(Form::date('due_date',null,array('class'=>'form-control','required'=>'required'))); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('invoice_number', __('Invoice Number'),['class'=>'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <input type="hidden" class="form-control" value="<?php echo e($invoice_number); ?>" >
                                           <?php echo e(Form::text('invoicenum', null, array('class' => 'form-control'))); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('category_id', $category,null, array('class' => 'form-control select','required'=>'required'))); ?>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('ref_number', __('Ref Number'),['class'=>'form-label'])); ?>

                                        <div class="form-icon-user">
                                            <span><i class="ti ti-joint"></i></span>
                                            <?php echo e(Form::text('ref_number', null, array('class' => 'form-control'))); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-control custom-checkbox mt-4">
                                        <input class="custom-control-input" type="checkbox" name="discount_apply" id="discount_apply" <?php echo e($invoice->discount_apply==1?'checked':''); ?>>
                                        <label class="custom-control-label form-label" for="discount_apply"><?php echo e(__('Discount Apply')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('sku',__('SKU'))); ?>

                                        <?php echo Form::text('sku', null,array('class' => 'form-control','required'=>'required')); ?>

                                    </div>
                                </div>
                                <?php if(!$customFields->isEmpty()): ?>
                                    <div class="col-md-6">
                                        <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                                            <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4"><?php echo e(__('Product & Services')); ?></h5>
            <div class="card repeater" data-value='<?php echo json_encode($invoice->items); ?>'>
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <div class="all-button-box">
                                <a href="#" data-repeater-create="" class="btn btn-primary mr-2" data-toggle="modal" data-target="#add-bank">
                                    <i class="ti ti-plus"></i> <?php echo e(__('Add item')); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 table-custom-style" data-repeater-list="items" id="sortable-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Items')); ?></th>
                                <th><?php echo e(__('Stores')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Price')); ?> </th>
                                <th></th>
                                <th class="text-end"><?php echo e(__('Amount')); ?> </th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="ui-sortable" data-repeater-item>
                            <tr>
                                <?php echo e(Form::hidden('id',null, array('class' => 'form-control id'))); ?>

                                <td width="25%" class="form-group pt-0">
                                    <?php echo e(Form::select('item', $product_services,null, array('class' => 'form-control item select','data-url'=>route('invoice.product')))); ?>


                                </td>
                                <td  class="form-group pt-0">
                                    <?php echo e(Form::select('store', $store,null, array('class' => 'form-control prod_store select','data-url'=>route('invoice.store')))); ?>


                                </td>
                                <td>

                                    <div class="form-group price-input input-group search-form">
                                        <?php echo e(Form::text('quantity',null, array('class' => 'form-control quantity','required'=>'required','placeholder'=>__('Qty'),'required'=>'required'))); ?>

                                        <span class="unit input-group-text bg-transparent"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input input-group search-form">
                                        <?php echo e(Form::text('price',null, array('class' => 'form-control price','required'=>'required','placeholder'=>__('Price'),'required'=>'required'))); ?>

                                        <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group price-input input-group search-form">
                                        <?php echo e(Form::hidden('discount',null, array('class' => 'form-control discount','required'=>'required','placeholder'=>__('Discount')))); ?>

                                        <!-- <span class="input-group-text bg-transparent"><?php echo e(\Auth::user()->currencySymbol()); ?></span> -->
                                    </div>
                                </td>
                                <td class="text-end amount">0.00</td>

                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice product')): ?>
                                        <a href="#" class="ti ti-trash text-white text-danger delete_item" data-repeater-delete></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    <div class="form-group">
                                        <?php echo e(Form::hidden('description', null, ['class'=>'form-control description','rows'=>'1','placeholder'=>__('Description')])); ?>

                                        <?php echo e(Form::text('thpl','', array('class' => 'form-control pro_description','required'=>'required','placeholder'=>__('3PL')))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    <?php echo e(Form::text('boxno','null', array('class' => 'form-control boxno','required'=>'required','placeholder'=>__('No of Box')))); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                    <?php echo e(Form::text('boxcost','null', array('class' => 'form-control boxcost','required'=>'required','placeholder'=>__('Box Cost')))); ?>

                                    </div>
                                </td>
                                <td>
                                <?php echo e(Form::hide('expense','', array('class' => 'form-control expense','required'=>'required','placeholder'=>__('Expense')))); ?>

                                </td>
                                <td>
                                <?php echo e(Form::hide('budget','', array('class' => 'form-control newbudget','required'=>'required','placeholder'=>__('Budget')))); ?>

                                </td>
                                <td class="text-end thplamount">0.00</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Sub Total')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end subTotal">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td><strong><?php echo e(__('Processing fee(2.95%)')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalTax">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="blue-text"><strong><?php echo e(__('Total Amount')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td class="text-end totalAmount blue-text">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td ><strong><?php echo e(__('Store budget')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td  class="text-end storename">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td ><strong><?php echo e(__('Total Balance')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td  class="text-end blnce">0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td></td>
                                <td ><strong><?php echo e(__('Remaining Balance')); ?> (<?php echo e(\Auth::user()->currencySymbol()); ?>)</strong></td>
                                <td  class="text-end budget">0.00</td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="<?php echo e(__('Cancel')); ?>" onclick="location.href = '<?php echo e(route("invoice.index")); ?>';" class="btn btn-light">
            <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\product\resources\views/invoice/edit.blade.php ENDPATH**/ ?>