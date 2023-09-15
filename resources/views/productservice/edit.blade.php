{{ Form::model($productService, array('route' => array('productservice.update', $productService->id), 'method' => 'PUT')) }}
<div class="modal-body">
<div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('name', __('Name'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::text('name',null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('sku', __('SKU'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                {{ Form::text('sku',null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>
           <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('date', __('Date'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::date('date',null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>


        <div class="form-group col-md-4">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('asin', __('ASIN'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::text('asin',null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('amzlink', __('AMZ Link'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                {{ Form::text('amzlink',null, array('class' => 'form-control','required'=>'required')) }}
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('sourcelink', __('Source Link'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                {{ Form::text('sourcelink',null, array('class' => 'form-control','required'=>'required')) }}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('asourceprice', __('Actual Source Price'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                {{ Form::number('asourceprice',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'srcprice')) }}
                   
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('sourceprice', __('Source Price'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::number('sourceprice',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'asrcprice')) }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('sourcepack', __('Source Pack'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('sourcepack',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'srcpack')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('quantity', __('Quantity to purchase'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('quantity',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'qty')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('selpack', __('Selling Pack'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::text('selpack',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'selpack')) }}
        </div>


        <div class="form-group col-md-4">
            {{ Form::label('shipping', __('Shipping'),['class'=>'form-label']) }}
            {{ Form::number('shipping',null, array('class' => 'form-control','step'=>'0.01','id'=>'shiping')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('tax_id', __('Tax'),['class'=>'form-label']) }}
            {{ Form::number('tax_id',null, array('class' => 'form-control','step'=>'0.01','id'=>'tax')) }}
        </div>
          <div class="form-group col-md-4">
            {{ Form::label('totalcostin', __('Total cost In. ST'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('totalcostin',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'costin')) }}
        </div>


        <div class="col-md-4">
            <div class="form-group">
            {{ Form::label('purchase_price', __('Purchase cost In. ST'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            <div class="form-icon-user">
            {{ Form::number('purchase_price',null, array('class' => 'form-control','required'=>'required','step'=>'0.01' ,'id'=>'costex')) }}

            </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('totalcost', __('Total cost '),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('totalcost',null, array('class' => 'form-control','required'=>'required','step'=>'0.01' ,'id'=>'cost')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('unit_id', __('AMZ Unit'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('unit_id',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'unit')) }}
        </div>
     
        <div class="form-group col-md-4">
            {{ Form::label('bundlecost', __('Bundle cost '),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('bundlecost',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'bundlecost')) }}
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('sale_price', __('Selling Price'),['class'=>'form-label']) }}<span class="text-danger">*</span>
                <div class="form-icon-user">
                    {{ Form::number('sale_price',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'saleprice')) }}
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('fbafee', __('FBA Fee '),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('fbafee',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'fbafee')) }}
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('reffee', __('Ref Fee '),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('reffee',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'reffee')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('amzship', __('AMZ Shipment'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('amzship',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'amzship')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('thpl', __('3pl'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('thpl',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'thpl')) }}
        </div>


        <div class="form-group col-md-4">
            {{ Form::label('profit', __('Profit'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('profit',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'profit')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('costexl', __('Cost Exl.FBA'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('costexl',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'costexl')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('costexlfb', __('Cost Exl. Ref & FBA'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('costexlfb',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'costexlfb')) }}
        </div>


        <div class="form-group col-md-4">
            {{ Form::label('totlrev', __('Total Revenue'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('totlrev',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'totlrev')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('netprofit', __('Net Profit'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('netprofit',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'netprofit')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('orderval', __('Order Value'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('orderval',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'orderval')) }}
        </div>

        
        <div class="form-group col-md-4">
            {{ Form::label('roi', __('ROI'),['class'=>'form-label']) }}<span class="text-danger">*</span>
            {{ Form::number('ROI',null, array('class' => 'form-control','required'=>'required','step'=>'0.01','id'=>'roi')) }}

        </div>  
        @if(!$customFields->isEmpty())
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="tab-pane fade show" id="tab-2" role="tabpanel">
                    @include('customFields.formBuilder')
                </div>
            </div>
        @endif
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Update')}}" class="btn  btn-primary">
</div>
{{Form::close()}}

<script type="text/javascript">
    $('#srcprice').change(function(e) {
     var value = $('#srcprice').val();
     var srcval = (value * 5 / 100) ;
     var sum = parseFloat(srcval.toFixed(2)) + parseFloat(value);
     $('#asrcprice').val(sum);
     var qty= $('#qty').val();
     var ship= $('#shiping').val();
     var tax= $('#tax').val();
     var unit= $('#unit').val();
     var totalin =  parseFloat(sum.toFixed(2)) *  parseFloat(qty) +  parseFloat(ship) +  parseFloat(tax);
     $('#costin').val(totalin);
     $('#orderval').val(totalin);
     $('#cost').val(totalin);
     var totalex =  parseFloat(sum.toFixed(2)) *  parseFloat(qty);
     $('#costex').val(totalex);
     var bundlec = totalin / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
   });

   $('#qty').change(function(e) {
     var value = $('#srcprice').val();
     var srcval = (value * 5 / 100) ;
     var sum = parseFloat(srcval.toFixed(2)) + parseFloat(value);
     var qty= $('#qty').val();
     var ship= $('#shiping').val();
     var tax= $('#tax').val();
     var srcpack= $('#srcpack').val();
     var selpack= $('#selpack').val();
     var profit= $('#selpack').val();
     var totalin =  parseFloat(sum.toFixed(2)) *  parseFloat(qty) +  parseFloat(ship) +  parseFloat(tax);
     $('#costin').val(totalin);
     $('#orderval').val(totalin);
     $('#cost').val(totalin);
     var totalex =  parseFloat(sum.toFixed(2)) *  parseFloat(qty);
     $('#costex').val(totalex);
     var unit = srcpack / selpack * qty;
     $('#unit').val(unit);
     var bundlec = totalin / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
   });

   $('#ship').change(function(e) {
     var value = $('#srcprice').val();
     var srcval = (value * 5 / 100) ;
     var sum = parseFloat(srcval.toFixed(2)) + parseFloat(value);
     var qty= $('#qty').val();
     var unit= $('#unit').val();
     var ship= $('#shiping').val();
     var tax= $('#tax').val();
     var totalin =  parseFloat(sum.toFixed(2)) *  parseFloat(qty) +  parseFloat(ship) +  parseFloat(tax);
     var bundlec = totalin / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
     $('#costin').val(totalin);
     $('#orderval').val(totalin);
     $('#cost').val(totalin);
   });

 $('#tax').change(function(e) {
     var value = $('#srcprice').val();
     var srcval = (value * 5 / 100) ;
     var sum = parseFloat(srcval.toFixed(2)) + parseFloat(value);
     var qty= $('#qty').val();
     var ship= $('#shiping').val();
     var unit= $('#unit').val();
     var tax= $('#tax').val();
     var totalin =  parseFloat(sum.toFixed(2)) *  parseFloat(qty) +  parseFloat(ship) +  parseFloat(tax);
     var bundlec = totalin / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
     $('#costin').val(totalin);
     $('#orderval').val(totalin);
     $('#cost').val(totalin);
   });
   
   $('#srcpack').change(function(e) {
     var qty= $('#qty').val();
     var srcpack= $('#srcpack').val();
     var selpack= $('#selpack').val();
     var unit = srcpack / selpack * qty;
     $('#unit').val(unit.toFixed(2));
     var profit= $('#profit').val();
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
   });

   $('#selpack').change(function(e) {
     var qty= $('#qty').val();
     var srcpack= $('#srcpack').val();
     var selpack= $('#selpack').val();
     var unit = srcpack / selpack * qty;
     $('#unit').val(unit.toFixed(2));
     var profit= $('#profit').val();
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
   });

   
   $('#cost').change(function(e) {
     var cost= $('#cost').val();
     var unit= $('#unit').val();
     var bundlec = cost / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
    });
    $('#unit').change(function(e) {
     var cost= $('#cost').val();
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var saleprice= $('#saleprice').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var profit= $('#profit').val();
     var amzship= $('#amzship').val();
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2));
     var bundlec = cost / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
     var totalrev = unit * saleprice;
     $('#totlrev').val(totalrev.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
   });

   $('#cost').change(function(e) {
    var cost= $('#cost').val();
     var unit= $('#unit').val();
     var bundlec = cost / unit ;
     $('#bundlecost').val(bundlec.toFixed(2));
    });


   $('#saleprice').change(function(e) {
     var saleprice= $('#saleprice').val();
     var ref = saleprice * 15/100;
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var amzship= $('#amzship').val();
     $('#reffee').val(ref.toFixed(2));
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
     var totalrev = unit * saleprice;
     $('#totlrev').val(totalrev.toFixed(2));
   });

   $('#bundlecost').change(function(e) {
     var saleprice= $('#saleprice').val();
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var amzship= $('#amzship').val();
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2)); 
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
     var costexl = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexl').val(costexl.toFixed(2));
     var costexlfb = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexlfb').val(costexlfb.toFixed(2));
 
   });

   $('#fbafee').change(function(e) {
     var saleprice= $('#saleprice').val();
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var amzship= $('#amzship').val();
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2));
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
   });

   $('#thpl').change(function(e) {
     var saleprice= $('#saleprice').val();
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var amzship= $('#amzship').val();
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2));
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
     var costexl = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexl').val(costexl.toFixed(2));
     var costexlfb = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexlfb').val(costexlfb.toFixed(2));
   });

   $('#reffee').change(function(e) {
     var saleprice= $('#saleprice').val();
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var amzship= $('#amzship').val();
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2));
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
     var costexl = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexl').val(costexl.toFixed(2));
     var costexlfb = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexlfb').val(costexlfb.toFixed(2));
   });

   $('#amzship').change(function(e) {
     var saleprice= $('#saleprice').val();
     var unit= $('#unit').val();
     var bundlecost= $('#bundlecost').val();
     var reffee= $('#reffee').val();   
     var fbafee= $('#fbafee').val();
     var thpl= $('#thpl').val();
     var amzship= $('#amzship').val();
     thplv = thpl / unit;
     azmshipv = amzship / unit;
     var profit = parseFloat(saleprice) - parseFloat(bundlecost) - parseFloat(fbafee) - parseFloat(reffee) - parseFloat(thplv) - parseFloat(azmshipv);;
     $('#profit').val(profit.toFixed(2));
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
     var costexl = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexl').val(costexl.toFixed(2));
     var costexlfb = parseFloat(bundlecost) +  parseFloat(reffee) + parseFloat(thplv) + parseFloat(azmshipv);;
     $('#costexlfb').val(costexlfb.toFixed(2));
   });

   $('#profit').change(function(e) {
      var unit= $('#unit').val();
     var profit= $('#profit').val();
     var bundlecost= $('#bundlecost').val();
     var netprofit = unit * profit;
     $('#netprofit').val(netprofit.toFixed(2));
     var roi = profit / bundlecost * 100;
     $('#roi').val(roi.toFixed(2));
    });

    
   $('#costin').change(function(e) {
      var costin= $('#costin').val();
     $('#orderval').val(costin.toFixed(2));
    });


</script>