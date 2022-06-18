<head>
    <?php include("head.php"); ?>

    <!-- order jquery -->
    <script type="text/javascript" src="order.js"></script>
</head>

<?php
include("header.php");

include("sidebar.php");
?>


<!-- main content start -->
<div class="main-container">
    <div class="card">
        <div style="text-align:center;" class="card-header">
            <h3>New Orders</h3>
        </div>

        <div class="card-body">
            <form method="POST" id="invoice_form">
                <div class="form-group row">
                    <label class="col-sm-3">Order Date : </label>
                    <div class="col-sm-3">
                        <input type="date" name="order_date" id="order_date">
                    </div>
                    <label class="col-sm-3">Customer Name* : </label>
                    <div class="col-sm-3">
                        <input type="text" name="customer_name" id="customer_name" required />
                    </div>
                    <label class="col-sm-3">Particulars* : </label>
                    <div class="col-sm-3">
                        <input type="text" name="particular" id="particular" required />
                    </div>
                    <label class="col-sm-3">Address : </label>
                    <div class="col-sm-3">
                        <textarea type="text" name="customer_address" id="customer_address"></textarea>
                    </div>
                    <label class="col-sm-3">GST/VAT : </label>
                    <div class="col-sm-3">
                        <input type="text" name="customer_gst" id="customer_gst">
                    </div>
                    <label class="col-sm-3">PAN : </label>
                    <div class="col-sm-3">
                        <input type="text" name="customer_pan" id="customer_pan">
                    </div>
                    <label class="col-sm-3">Invoice type* : </label>
                    <div class="col-sm-3">
                        <select name="invoice_type" id="invoice_type" class="form-control required">
                            <option value="" disabled selected>Choose...</option>
                            <option value="Hosting">Hosting</option>
                            <option value="Publications">Publication</option>
                            <option value="Conference">Conference</option>
                            <option value="Award">Award</option>
                            <option value="S/W Development">S/W Development</option>
                            <option value="WebDesign">WebDesign</option>
                            <option value="AppDesign">AppDesign</option>
                            <option value="LogoDesign">LogoDesign</option>
                        </select>
                    </div>
                </div>

                <div class="card" style="box-shadow : 0 0 15px lightgrey; margin-top:10px;">
                    <div align="center">
                        <h4>Make a Order List</h4>
                    </div>
                    <div class="table-responsive">
                        <table id="invoice-item-table">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">#Id</th>
                                    <th style="text-align:center;">Item</th>
                                    <th style="text-align:center;">Quantity</th>
                                    <th style="text-align:center;">Amount(Rs.)</th>
                                    <th style="text-align:center;">Discount(%)</th>
                                    <th style="text-align:center;">Total</th>
                                </tr>
                            </thead>
                            <tbody id="invoice_item">
                                <tr id="row_id_1">
                                    <td id="sr_no">1</td>
                                    <td style="text-align:center;"><input type="text" name="particulars[]" id="particulars1" data-srno="1" required /></td>
                                    <td style="text-align:center;"><input type="number" class="qty" name="qty[]" id="qty1" data-srno="1" required /></td>
                                    <td style="text-align:center;"><input type="number" class="amount" name="amount[]" id="amount1" data-srno="1" required /></td>
                                    <td style="text-align:center;"><input type="number" class="discount" value="0" name="discount[]" id="discount1" data-srno="1" /></td>
                                    <td style="text-align:center;"><input type="text" class="total" value="0" name="total[]" id="total1" data-srno="1" readonly /></td>
                                </tr>
                            </tbody>
                        </table>
                        <center style="padding:10px;">
                            <div id="add" style="width:150px; " class="btn btn-success">Add</div>
                        </center>
                    </div>
                </div>

                <div style="padding:10px;" class="form-group row">
                    <label class="col-lg-6">Total : </label>
                    <div class="col-lg-6">
                        <input id="sub_total" name="sub_total" type="text">
                    </div>

                    <label class="col-lg-6">GST(18%) : </label>
                    <div class="col-lg-6">
                        <input id="gst" name="gst" type="text">
                    </div>
                    <label class="col-lg-6">Grand Total : </label>
                    <div class="col-lg-6">
                        <input id="net" name="net" type="text">
                    </div>
                    <label class="col-sm-6">in words : </label>
                    <div class="col-sm-6">
                        <span id="words">Zero</span>
                    </div>
                </div>

                <center style="padding:10px;">
                    <input type="hidden" name="total_item" id="total_item" value="1" />
                    <input type="hidden" name="order_id" id="order_id" />
                    <button style="width:150px; " type="submit" id="order" name="order" class="btn btn-primary">Order</button>
                </center>
            </form>
        </div>
    </div>
</div>

<!-- main content end -->

<?php include("footer.php"); ?>