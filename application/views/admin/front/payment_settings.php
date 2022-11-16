<section class="edu_admin_content">
	<div class="edu_admin_right sectionHolder edu_siteSetting_wrapper">
	    
			<div class="pxn_admin_informationdiv edu_main_wrapper">
				<form class="pxn_amin form" enctype="multipart/form-data" method="post">
					<div class="edu_site_setting_wrap edu_from_wrapper">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-12">
							    <div class="form-group">
    							    <label><?php echo html_escape($this->common->languageTranslator('ltr_payment_type'));?><sup>*</sup></label>
    							    <br>
										<input type="radio" <?php if($payment_type==1){echo 'checked';} if($payment_type!=1 && $payment_type!=2){echo 'checked';} ?> name="payment_type" value="1"><span><?php echo html_escape($this->common->languageTranslator('ltr_razorpay'));?></span>
										
										<input type="radio" <?php if($payment_type==2){echo 'checked';} ?> name="payment_type" value="2"><span><?php echo html_escape($this->common->languageTranslator('ltr_paypal'));?></span>
        							
							    </div>
							</div>
							
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_razorpay_key_id'));?><sup>*</sup></label>
									<input type="text" class="form-control <?php if($payment_type==1){echo 'require';} ?>" name="razorpay_key_id" value="<?php if(!empty($razorpay_key_id)){echo $razorpay_key_id;} ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_key_id'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_razorpay_secret_key'));?><sup>*</sup></label>
									<input type="text" name="razorpay_secret_key" value="<?php if(!empty($razorpay_secret_key)){echo $razorpay_secret_key ;} ?>" class="form-control " placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_secret_key'));?>">
								</div>
							</div> 
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_paypal_client_id'));?><sup>*</sup></label>
									<input type="text" class="form-control  <?php if($payment_type==2){echo 'require';} ?>" name="paypal_client_id" value="<?php if(!empty($paypal_client_id)){echo $paypal_client_id ;} ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_client_id'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_sandbox_accounts'));?><sup>*</sup></label>
									<input type="text" class="form-control <?php if($payment_type==2){echo 'require';} ?>" name="sandbox_accounts" value="<?php if(!empty($sandbox_accounts)){echo $sandbox_accounts; } ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_sandbox_accounts'));?>">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-12">
							    <div class="form-group">
									<label><?php echo html_escape($this->common->languageTranslator('ltr_currency'));?><sup>*</sup></label>
									<select class="edu_selectbox_with_search form-control require"  data-placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_currency'));?>" name="currency_code">
										<option value=""><?php echo html_escape($this->common->languageTranslator('ltr_currency'));?></option>
										<option  <?php if($currency_code=='ALL'){echo 'selected';} ?> value="ALL">Albania Lek &#76;&#101;&#107;</option>
										<option  <?php if($currency_code=='AFN'){echo 'selected';} ?> value="AFN">Afghanistan Afghani &#1547;</option>
										<option  <?php if($currency_code=='ARS'){echo 'selected';} ?> value="ARS">Argentina Peso &#36;</option>
										<option  <?php if($currency_code=='AWG'){echo 'selected';} ?> value="AWG">Aruba Guilder &#402;</option>
										<option  <?php if($currency_code=='AUD'){echo 'selected';} ?> value="AUD">Australia Dollar &#36;</option>
										<option  <?php if($currency_code=='AZN'){echo 'selected';} ?> value="AZN">Azerbaijan New Manat &#1084;&#1072;&#1085;</option>
										<option  <?php if($currency_code=='BSD'){echo 'selected';} ?> value="BSD">Bahamas Dollar &#36;</option>
										<option  <?php if($currency_code=='BBD'){echo 'selected';} ?> value="BBD">Barbados Dollar &#36;</option>
										<option  <?php if($currency_code=='BYN'){echo 'selected';} ?> value="BYN">Belarus Ruble 	&#66;&#114;</option>
										<option  <?php if($currency_code=='BZD'){echo 'selected';} ?> value="BZD">Belize Dollar 	&#66;&#90;&#36;</option>
										<option  <?php if($currency_code=='BMD'){echo 'selected';} ?> value="BMD">Bermuda Dollar  &#36;</option>
										<option  <?php if($currency_code=='BOB'){echo 'selected';} ?> value="BOB">Bolivia Bolíviano 	&#36;&#98;</option>
										<option  <?php if($currency_code=='BAM'){echo 'selected';} ?> value="BAM">Bosnia and Herzegovina Convertible Marka 	&#75;&#77;</option>
										<option  <?php if($currency_code=='BWP'){echo 'selected';} ?> value="BWP">Botswana Pula &#80;</option>
										<option  <?php if($currency_code=='BGN'){echo 'selected';} ?> value="BGN">Bulgaria Lev &#1083;&#1074;</option>
										<option  <?php if($currency_code=='BRL'){echo 'selected';} ?> value="BRL">Brazil Real &#82;&#36;</option>
										<option  <?php if($currency_code=='BND'){echo 'selected';} ?> value="BND">Brunei Darussalam Dollar &#36;</option>
										<option  <?php if($currency_code=='KHR'){echo 'selected';} ?> value="KHR">Cambodia Riel &#6107;</option>
										<option  <?php if($currency_code=='CAD'){echo 'selected';} ?> value="CAD">Canada Dollar &#36;</option>
										<option  <?php if($currency_code=='KYD'){echo 'selected';} ?> value="KYD">Cayman Islands Dollar &#36;</option>
										<option  <?php if($currency_code=='CLP'){echo 'selected';} ?> value="CLP">Chile Peso &#36;</option>
										<option  <?php if($currency_code=='CNY'){echo 'selected';} ?> value="CNY">China Yuan Renminbi &#165;</option>
										<option  <?php if($currency_code=='COP'){echo 'selected';} ?> value="COP">Colombia Peso &#36;</option>
										<option  <?php if($currency_code=='CRC'){echo 'selected';} ?> value="CRC">Costa Rica Colon &#8353;</option>
										<option  <?php if($currency_code=='HRK'){echo 'selected';} ?> value="HRK">Croatia Kuna &#107;&#110;</option>
										<option  <?php if($currency_code=='CUP'){echo 'selected';} ?> value="CUP">Cuba Peso &#8369;</option>
										<option  <?php if($currency_code=='CZK'){echo 'selected';} ?> value="CZK">Czech Republic Koruna &#75;&#269;</option>
										<option  <?php if($currency_code=='DKK'){echo 'selected';} ?> value="DKK">Denmark Krone  &#107;&#114;</option>
										<option  <?php if($currency_code=='DOP'){echo 'selected';} ?> value="DOP">Dominican Republic Peso &#82;&#68;&#36;</option>
										<option  <?php if($currency_code=='XCD'){echo 'selected';} ?> value="XCD">East Caribbean Dollar &#36;</option>
										<option  <?php if($currency_code=='EGP'){echo 'selected';} ?> value="EGP">Egypt Pound &#163;</option>
										<option  <?php if($currency_code=='SVC'){echo 'selected';} ?> value="SVC">El Salvador Colon  &#36;</option>
										<option  <?php if($currency_code=='EUR'){echo 'selected';} ?> value="EUR">Euro Member Countries &#8364;</option>
										<option  <?php if($currency_code=='FKP'){echo 'selected';} ?> value="FKP">Falkland Islands (Malvinas) Pound  &#163;</option>
										<option  <?php if($currency_code=='FJD'){echo 'selected';} ?> value="FJD">Fiji Dollar &#36;</option>
										<option  <?php if($currency_code=='GHS'){echo 'selected';} ?> value="GHS">Ghana Cedi &#162;</option>
										<option  <?php if($currency_code=='GIP'){echo 'selected';} ?> value="GIP">Gibraltar Pound &#163;</option>
										<option  <?php if($currency_code=='GTQ'){echo 'selected';} ?> value="GTQ">Guatemala Quetzal &#81;</option>
										<option  <?php if($currency_code=='GGP'){echo 'selected';} ?> value="GGP">Guernsey Pound &#163;</option>
										<option  <?php if($currency_code=='GYD'){echo 'selected';} ?> value="GYD">Guyana Dollar &#36;</option>
										<option  <?php if($currency_code=='HNL'){echo 'selected';} ?> value="HNL">Honduras Lempira  &#76;</option>
										<option  <?php if($currency_code=='HKD'){echo 'selected';} ?> value="HKD">Hong Kong Dollar &#36;</option>
										<option  <?php if($currency_code=='HUF'){echo 'selected';} ?> value="HUF">Hungary Forint &#70;&#116;</option>
										<option  <?php if($currency_code=='ISK'){echo 'selected';} ?> value="ISK">Iceland Krona &#107;&#114;</option>
										<option  <?php if($currency_code=='INR'){echo 'selected';} ?> value="INR">India Rupee &#8377;</option>
										<option  <?php if($currency_code=='IDR'){echo 'selected';} ?> value="IDR">Indonesia Rupiah &#82;&#112;</option>
										<option  <?php if($currency_code=='IRR'){echo 'selected';} ?> value="IRR">Iran Rial &#65020;</option>
										<option  <?php if($currency_code=='IMP'){echo 'selected';} ?> value="IMP">Isle of Man Pound 	&#163;</option>
										<option  <?php if($currency_code=='ILS'){echo 'selected';} ?> value="ILS">Israel Shekel &#8362;</option>
										<option  <?php if($currency_code=='JMD'){echo 'selected';} ?> value="JMD">Jamaica Dollar &#74;&#36;</option>
										<option  <?php if($currency_code=='JPY'){echo 'selected';} ?> value="JPY">Japan Yen &#165;</option>
										<option  <?php if($currency_code=='JEP'){echo 'selected';} ?> value="JEP">Jersey Pound &#163;</option>
										<option  <?php if($currency_code=='KZT'){echo 'selected';} ?> value="KZT">Kazakhstan Tenge &#1083;&#1074;</option>
										<option  <?php if($currency_code=='KPW'){echo 'selected';} ?> value="KPW">Korea (North) Won &#8361;</option>
										<option  <?php if($currency_code=='KRW'){echo 'selected';} ?> value="KRW">Korea (South) Won &#8361;</option>
										<option  <?php if($currency_code=='KGS'){echo 'selected';} ?> value="KGS">Kyrgyzstan Som  &#1083;&#1074;</option>
										<option  <?php if($currency_code=='LAK'){echo 'selected';} ?> value="LAK">Laos Kip &#8365;</option>
										<option  <?php if($currency_code=='LBP'){echo 'selected';} ?> value="LBP">Lebanon Pound &#163;</option>
										<option  <?php if($currency_code=='LRD'){echo 'selected';} ?> value="LRD">Liberia Dollar &#36;</option>
										<option  <?php if($currency_code=='MKD'){echo 'selected';} ?> value="MKD">Macedonia Denar &#1076;&#1077;&#1085;</option>
										<option  <?php if($currency_code=='MYR'){echo 'selected';} ?> value="MYR">Malaysia Ringgit &#82;&#77;</option>
										<option  <?php if($currency_code=='MUR'){echo 'selected';} ?> value="MUR">Mauritius Rupee &#8360;</option>
										<option  <?php if($currency_code=='MXN'){echo 'selected';} ?> value="MXN">Mexico Peso &#36;</option>
										<option  <?php if($currency_code=='MNT'){echo 'selected';} ?> value="MNT">Mongolia Tughrik &#8366;</option>
										<option  <?php if($currency_code=='MZN'){echo 'selected';} ?> value="MZN">Mozambique Metical &#77;&#84;</option>
										<option  <?php if($currency_code=='NAD'){echo 'selected';} ?> value="NAD">Namibia Dollar &#36;</option>
										<option  <?php if($currency_code=='NPR'){echo 'selected';} ?> value="NPR">Nepal Rupee &#8360;</option>
										<option <?php if($currency_code=='ANG'){echo 'selected';} ?> value="ANG">Netherlands Antilles Guilder &#402;</option>
										<option <?php if($currency_code=='NZD'){echo 'selected';} ?> value="NZD">New Zealand Dollar &#402;</option>
										<option <?php if($currency_code=='NIO'){echo 'selected';} ?> value="NIO">New Zealand Dollar &#36;</option>
										<option <?php if($currency_code=='NGN'){echo 'selected';} ?> value="NGN">Nicaragua Cordoba &#67;&#36;</option>
										<option <?php if($currency_code=='NGN'){echo 'selected';} ?> value="NGN">Nigeria Naira 	&#8358;</option>
										<option <?php if($currency_code=='KPW'){echo 'selected';} ?> value="KPW">Korea (North) Won &#8361;</option>
										<option <?php if($currency_code=='NOK'){echo 'selected';} ?> value="NOK">Norway Krone &#107;&#114;</option>
										<option <?php if($currency_code=='OMR'){echo 'selected';} ?> value="OMR">Oman Rial &#65020;</option>
										<option <?php if($currency_code=='PKR'){echo 'selected';} ?> value="PKR">Pakistan Rupee  &#8360;</option>
										<option <?php if($currency_code=='PAB'){echo 'selected';} ?> value="PAB">Panama Balboa  &#66;&#47;&#46;</option>
										<option <?php if($currency_code=='PYG'){echo 'selected';} ?> value="PYG">Paraguay Guarani &#71;&#115;</option>
										<option <?php if($currency_code=='PEN'){echo 'selected';} ?> value="PEN">Peru Sol &#83;&#47;&#46;</option>
										<option <?php if($currency_code=='PHP'){echo 'selected';} ?> value="PHP">Philippines Peso &#8369;</option>
										<option <?php if($currency_code=='PLN'){echo 'selected';} ?> value="PLN">Poland Zloty &#122;&#322;</option>
										<option <?php if($currency_code=='QAR'){echo 'selected';} ?> value="QAR">Qatar Riyal &#65020;</option>
										<option <?php if($currency_code=='RON'){echo 'selected';} ?> value="RON">Romania New Leu &#108;&#101;&#105;</option>
										<option <?php if($currency_code=='RUB'){echo 'selected';} ?> value="RUB">Russia Ruble &#1088;&#1091;&#1073;</option>
										<option <?php if($currency_code=='SHP'){echo 'selected';} ?> value="SHP">Saint Helena Pound &#163;</option>
										<option <?php if($currency_code=='SAR'){echo 'selected';} ?> value="SAR">Saudi Arabia Riyal	&#65020;</option>
										<option <?php if($currency_code=='RSD'){echo 'selected';} ?> value="RSD">Serbia Dinar &#1044;&#1080;&#1085;&#46;</option>
										<option <?php if($currency_code=='SCR'){echo 'selected';} ?> value="SCR">Seychelles Rupee &#8360;</option>
										<option <?php if($currency_code=='SGD'){echo 'selected';} ?> value="SGD">Singapore Dollar &#36;</option>
										<option <?php if($currency_code=='SBD'){echo 'selected';} ?> value="SBD">Solomon Islands Dollar &#36;</option>
										<option <?php if($currency_code=='SOS'){echo 'selected';} ?> value="SOS">Somalia Shilling &#83;</option>
										<option <?php if($currency_code=='ZAR'){echo 'selected';} ?> value="ZAR">South Africa Rand 	&#82;</option>
										<option <?php if($currency_code=='KRW'){echo 'selected';} ?> value="KRW">Korea (South) Won &#8361;</option>
										<option <?php if($currency_code=='LKR'){echo 'selected';} ?> value="LKR">Sri Lanka Rupee &#8360;</option>
										<option <?php if($currency_code=='SEK'){echo 'selected';} ?> value="SEK">Sweden Krona &#107;&#114;</option>
										<option <?php if($currency_code=='CHF'){echo 'selected';} ?> value="CHF">Switzerland Franc &#67;&#72;&#70;</option>
										<option <?php if($currency_code=='SRD'){echo 'selected';} ?> value="SRD">Suriname Dollar &#36;</option>
										<option <?php if($currency_code=='SYP'){echo 'selected';} ?> value="SYP">Syria Pound &#163;</option>
										<option <?php if($currency_code=='TWD'){echo 'selected';} ?> value="TWD">Taiwan New Dollar &#78;&#84;&#36;</option>
										<option <?php if($currency_code=='THB'){echo 'selected';} ?> value="THB">Thailand Baht &#3647;</option>
										<option <?php if($currency_code=='TTD'){echo 'selected';} ?> value="TTD">Trinidad and Tobago Dollar &#84;&#84;&#36;</option>
										<option <?php if($currency_code=='TRY'){echo 'selected';} ?> value="TRY">Turkey Lira &#;</option>
										<option <?php if($currency_code=='TVD'){echo 'selected';} ?> value="TVD">Tuvalu Dollar 	&#36;</option>
										<option <?php if($currency_code=='UAH'){echo 'selected';} ?> value="UAH">Ukraine Hryvnia &#8372;</option>
										<option <?php if($currency_code=='GBP'){echo 'selected';} ?> value="GBP">United Kingdom Pound &#163;</option>
										<option <?php if($currency_code=='USD'){echo 'selected';} ?> value="USD">United States Dollar &#36;</option>
										<option <?php if($currency_code=='UYU'){echo 'selected';} ?> value="UYU">Uruguay Peso  &#36;&#85;</option>
										<option <?php if($currency_code=='UZS'){echo 'selected';} ?> value="UZS">Uzbekistan Som &#1083;&#1074;</option>
										<option <?php if($currency_code=='VEF'){echo 'selected';} ?> value="VEF">Venezuela Bolivar &#66;&#115;</option>
										<option <?php if($currency_code=='VND'){echo 'selected';} ?> value="VND">Viet Nam Dong &#8363;</option>
										<option <?php if($currency_code=='YER'){echo 'selected';} ?> value="YER">Yemen Rial &#65020;</option>
										<option <?php if($currency_code=='ZWD'){echo 'selected';} ?> value="ZWD">Zimbabwe Dollar &#90;&#36;</option>
									</select>
								</div>
							</div>
							
							<!--<div class="col-lg-6 col-md-6 col-sm-12 col-12">-->
							<!--    <div class="form-group">-->
							<!--		<label class="currency_tooltip"><?php echo html_escape($this->common->languageTranslator('ltr_currency_converter_API'));?><sup>*</sup>-->
							<!--		<span class="cstm_tooltip">Get your API key <a href="https://free.currencyconverterapi.com/" target="_blank"> Here</a></span>-->
							<!--		</label>-->
							<!--		<input type="text" class="form-control" name="currency_converter_api" value="<?php if(!empty($currency_converter_api)){echo $currency_converter_api; } ?>" placeholder="<?php echo html_escape($this->common->languageTranslator('ltr_api_key'));?>">-->
							<!--	</div>-->
							<!--</div>-->
							
							<div class="edu_btn_wrapper">
								<div class="col-lg-12 col-md-12 col-sm-12 col-12"> 
									<button type="button" class="btn btn-primary updatePayment"><?php echo html_escape($this->common->languageTranslator('ltr_save'));?></button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>		
	</div>
</section>