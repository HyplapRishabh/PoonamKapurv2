
<div class="latis">
    <div class="container" ng-controller="Walletcontroller" ng-init="init()">
        <div class="container_wallet">
            <div class="wallet">
                <div class="walletdetails">
                    
                    <form name="myForm">
                        <div class="wallteimg">
                            <img src="images/Paytm_wallet.png" class="pwalletimg">
                        </div>
                        <div class="walletbalence">
                            <span>Rs {{total_balance | number:2}}</span>
                            <br>
                            <span>Your Wallet Balance</span>
                        </div>
                        <div class="walltaddamout">
                                <input type="number" name="addMoney" ng-model="addMoney" ng-change="disabledPaymentOption()" placeholder="Enter Amount to be Added in Wallet" class="addtowallettextbox" ng-minlength="2" required>
                                <p ng-if="errorMessage">{{errorMessage}}</p>
                        </div>
                        <div class="walletbutton">
                            <button type="button" class="addmoneytowallet" ng-click="ShowPaymentMethod()" ng-disabled="myForm.$invalid">Add Money to Wallet</button>
                            
                        </div>
                    </form>
                </div>
                

                <!-- payumoney start -->
                <!-- this meta viewport is required for BOLT //-->
                <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
                <!-- BOLT Sandbox/test //-->
<!--                 <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
                color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script> -->
                <!-- BOLT Production/Live //-->
                <script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script> 
                <script type="text/javascript">
                function launchBOLT(){

                    // create angularjs object and access varible value
                    var dom_el = document.querySelector('[ng-controller="checkoutController"]');
                    var ng_el = angular.element(dom_el);
                    var scope = ng_el.scope();

                    //used wallet is checked or not
                   
                   bolt.launch({
                        key: $('#key').val(),
                        txnid: $('#txnid').val(), 
                        hash: $('#hash').val(),
                        amount: $('#amount').val(),
                        firstname: $('#fname').val(),
                        email: $('#email').val(),
                        phone: $('#mobile').val(),
                        productinfo: $('#pinfo').val(),
                        udf5: $('#udf5').val(),
                        surl : $('#surl').val(),
                        furl: $('#surl').val(),
                        mode: 'dropout' 
                    },{ responseHandler: function(BOLT){
                        console.log( BOLT);     
                        if(BOLT.response.txnStatus != 'CANCEL'){
                            //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                            var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
                            '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
                            '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
                            '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
                            '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
                            '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
                            '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
                            '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
                            '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
                            '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
                            '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
                            '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
                            '</form>';
                            var form = jQuery(fr);
                            jQuery('body').append(form);                                
                            form.submit();
                        }
                    },
                    catchException: function(BOLT){
                        console.log( BOLT );
                    }
                });

                    
                }
                //--
                </script>

                <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                          <!-- <div class="modal-walletaddmoneytoonline"> -->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Choose Payment Methods</h4>
                            </div>
                                    <form ng-show="afterClickAddMoney" action="database/addMoney.php" method="POST" >
                                        <div class="modal-body">
                                            
                                                <input type="hidden" name="AddToWalletAmount" value="{{addMoney}}" >
                                                
                                                <!--<label class="radio-inline rediobuttoncss">-->
                                                <!--  <input type="radio" name="payment_option" ng-click="showPaymentButtonWhenClick('instamojo')" >Instamojo-->
                                                <!--</label>-->
                                                <!--<label class="radio-inline">-->
                                                <!--  <input type="radio" name="payment_option" ng-click="showPaymentButtonWhenClick('payumoney')">Pay U Money-->
                                                <!--</label>-->
                                                <div class="rediobutnchoos1" ng-show="display_Instamojo">
                                                    <label class="rediobutn">Instamojo
                                                      <input type="radio" name="payment_option" ng-click="showPaymentButtonWhenClick('instamojo')">
                                                      <span class="checkmarkredio"></span>
                                                    </label>
                                                </div>
                                                <div class="rediobutnchoos2" ng-show="display_payUmoney">
                                                    <label class="rediobutn">Pay U Money
                                                      <input type="radio" name="payment_option" ng-click="showPaymentButtonWhenClick('payumoney')">
                                                      <span class="checkmarkredio"></span>
                                                    </label>
                                                </div>
                                        </div>
                                        <div class="modal-footer" ng-if="showInsta">
                                          <div class="walletbutton">
                                                    <button type="submit" name="instamojo" value="1" class="addmoneyinstamojo" ng-click="ShowPaymentMethod()" ng-disabled="myForm.$invalid">Proceed to instamojo</button>
                                                </div>
                                        </div>
                                    </form>

                                    <form ng-if="showPayMoney" action="#" id="payu_payment_form" >
                                        <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                                        <!-- <input type="hidden" ng-model="surl" id="surl" name="surl" ng-init="getCallbackUrl(payment)"/> -->
                                        <input type="hidden" ng-model="surl" id="surl" name="surl" ng-init="getCallbackUrl(payment)"/>
                                        <input type="hidden" id="key" name="key" placeholder="Merchant Key" value="" />
                                        <input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="" />
                                        <input type="hidden" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo date('YmdHis'). rand(10,9999);?>" />
                                        <input type="hidden" id="amount" name="amount" placeholder="Amount" value="0.00" />
                                        <input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" />
                                        <input type="hidden" id="fname" name="fname" placeholder="First Name" ng-model="fname" ng-change="getHashKey()"/>
                                        <input type="hidden" id="email" name="email" placeholder="Email ID" ng-model="emiail_id" ng-change="getHashKey()"/>
                                        <input type="hidden" id="mobile" name="mobile" placeholder="Mobile/Cell Number" ng-model="cell" ng-change="getHashKey()"/>
                                        <input type="hidden" id="hash" name="hash" ng-model="hash" placeholder="Hash"/>
                                        
                                        <div class="modal-footer">
                                            <div class="walletbutton">
                                                
                                                <button type="submit" class="addmoneypayum" onclick="launchBOLT(); return false;">Pay U Money</button>
    
                                            </div>
                                        </div>
                                    </form>
                                    
                          </div>
                          
                        </div>
                </div>

                

            </div>
            <br>
            <div class="wallet">
                <h4 class="headingtrahist">Transaction History</h4>
                <div class="trahiswallet">
                    <span>Balance</span>
                    <span class="badge">RS {{total_balance | number:2}}</span>
                </div>
                <div class="trahiswalletcredit">
                    <span>Total Credit</span>
                    <span class="badge">RS {{total_credit | number:2}}</span>
                </div>
                <div class="traavailbal">
                    <span>Total Debit</span>
                    <span class="badge">RS {{total_debit | number:2 }}</span>
                </div>
                <div class="table-responsive transctiodata">
                    <table>
                      <tr>
                        <!-- <th>#</th> -->
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                      </tr>
                      <tr ng-repeat="x in walletData" ng-init="getTotal(x)">
                        <!-- <td>{{$index}}</td> -->
                        <td>{{x.payment_transcation_id ? 'TXN ID ' + x.payment_transcation_id :'N/A'}}</td>
                        <td>{{x.payment_amount}} {{x.amount_status_type==1 ? 'Cr':'Dr' }}</td>
                        <td>{{x.payment_timestamp}}</td>
                        <td>
                            <label ng-if="x.payment_status==0">Failed</label>
                            <label ng-if="x.payment_status==1">Success</label>
                            <label ng-if="x.payment_status==2">Pending</label>
                        </td>
                      </tr>
                      <tr ng-if="!walletData.length">
                          <td colspan="4">
                              No transaction found
                          </td>
                      </tr>
                    </table>
                </div>
            </div>
            
            
        
        </div>
    
    </div>

</div>
