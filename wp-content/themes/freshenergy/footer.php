<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the id=main and id=page divs and all content after.
 *
 * @package Largo
 * @since 0.1
 */
?>


	</div> <!-- #main -->

<div class="row-fluid clearfix">
	<div id="fe-cta-footer">
		<div class="inner">
			<div class="widget span6">
				<h3><span>Make a Donation</span></h3>

				<?php 
					$id=19314; // "Donate Blurb"
					$post = get_post($id); 
					$content = apply_filters('the_content', $post->post_content); 
					echo $content;  
				?>
			</div>
			<div class="widget span6">
				<h3><span>Sign Up for News and Updates</span></h3>
				<!-- <form>
					<input type="text" placeholder="First Name" />
					<input type="text" placeholder="Last Name" />
					<input type="text" placeholder="Email" />
					<button type="submit">Sign Up</button>
				</form> -->
				<form name="pShoppingCartFormBean" method="post" action=
				  "https://www.z2systems.com/np/publicaccess/survey.do" onsubmit=
				  "return validateNeonForm();" id="pShoppingCartFormBean">
				    <input type="password" autocomplete='off' style='display:none' /><input type="hidden"
				    name="skipDuplicateRequestCheck" value="1" /><input type="hidden" name="surveyId"
				    value="3" /><input type="hidden" name="currentPage" value="1" /><input type="hidden"
				    name="direction" id="direction" value="next" />

				    <div id="surveyForm" class="tbmain">

				          <span id="person.firstName1">
				           <label>First Name</label>
				           <input type="text" name="person.firstName" maxlength=
				            "100" size="20" value="" id="person.firstName" class=
				            "control_textbox" placeholder="First Name"/>
				          </span>

				          <span id="person.lastName1">
				          	<label>Last Name</label>
				          	<input type="text" name="person.lastName" maxlength=
				            "100" size="20" value="" id="person.lastName" class="control_textbox" placeholder="Last Name" />
				          </span>

				          <span id="person.email11">
				            <label>Email</label>
				            <input type="text" name="person.email1" maxlength=
				            "100" size="20" value="" id="person.email1" class="control_textbox" placeholder="Email"/>
				          </span>

				          <span id="null1">
				            <input type="submit" name="null" class=
				            "control_button" value="Sign Up" id="null" />
				          </span>
				    </div><input type="hidden" name="orgId" value="freshenergy" />
				  </form>

				<SCRIPT src="https://www.z2systems.com/np/js/regExpValidate.js" type=text/javascript></SCRIPT>
				<script>
				function validateNeonStandardEmail() {
				    if (getElement("person.email1") && getElement("person.email1").value.trim().length > 0) {
				        return validateSurveyEmail(getElement("person.email1").value);
				    }
				    return true;
				} </script><SCRIPT language=javascript type=text/javascript > function validateNeonForm() {
				    if (document.getElementById("direction").value == "previous") {
				        return true;
				    }
				    if (!validateNeonStandardEmail()) {
				        alert("The Email Address is invalid.");
				        document.getElementById("person.email1").focus();
				        return false;
				    }
				    var buttons = document.getElementsByClassName("control_button");
				    for (var i = 0; i < buttons.length; i++) {
				        buttons[i].disabled = true;
				    }
				    return true;
				} </SCRIPT><SCRIPT language=javascript type=text/javascript > function populateValueFromRadio(textBoxId, radioId, hiddenObjId) {
				    var radios = document.getElementsByName(radioId);
				    var hiddenObj = document.getElementById(hiddenObjId);
				    var txtboxObj = document.getElementById(textBoxId);
				    for (var i = 0; i < radios.length; i++) {
				        if (radios[i].checked) {
				            hiddenObj.value = radios[i].value;
				        }
				    }
				    if (txtboxObj != undefined && (hiddenObj.value == null || hiddenObj.value == "")) {
				        var dAmt = trimAll(removeCurrency(txtboxObj.value));
				        if (dAmt == "") {
				            txtboxObj.focus();
				        } else {
				            hiddenObj.value = dAmt;
				        }
				    }
				}

				function leavingTextBox(textBoxId, radioId, hiddenObjId) {
				    var radios = document.getElementsByName(radioId);
				    var hiddenObj = document.getElementById(hiddenObjId);
				    var txtboxObj = document.getElementById(textBoxId);
				    for (var i = 0; i < radios.length; i++) {
				        if (radios[i].checked) {
				            hiddenObj.value = radios[i].value;
				            if (txtboxObj != undefined && (radios[i].value == null || radios[i].value == "")) {
				                var dAmt = trimAll(removeCurrency(txtboxObj.value));
				                if (dAmt == "") {
				                    alert("Please enter donation amount");
				                    txtboxObj.focus();
				                    return false;
				                } else if (validateNumeric(dAmt) == false) {
				                    alert("The donation amount should be a number.");
				                    txtboxObj.focus();
				                    return false;
				                } else if (validatePositiveAndZero(dAmt) == false) {
				                    alert("The donation amount should be bigger than 0.");
				                    return false;
				                } else if (validateNumeric(dAmt) == true) {
				                    var numdAmt = dAmt;
				                    numdAmt = numdAmt.replace(',', '');
				                    while (numdAmt.indexOf(',') != -1) {
				                        numdAmt = numdAmt.replace(',', '');
				                    }
				                    numdAmt = numdAmt.split('.');
				                    if (numdAmt[0].length > 13) {
				                        alert('Your donation amount is too large.');
				                        return false;
				                    }
				                    hiddenObj.value = dAmt;
				                    return true;
				                }
				            }
				            return true;
				        }
				    }
				}

				function validatePositiveAndZero(val) {
				    if (Number(val) <= 0) {
				        return false;
				    }
				}

				function validateAmount() {
				    var txtboxObj = document.getElementById('donation.amount');
				    if (txtboxObj != undefined) {
				        var dAmt = trimAll(removeCurrency(txtboxObj.value));
				        if (dAmt == "") {
				            alert("Please enter donation amount");
				            txtboxObj.focus();
				            return false;
				        } else if (validateNumeric(dAmt) == false) {
				            alert("The donation amount should be a number.");
				            txtboxObj.focus();
				            return false;
				        } else if (validatePositiveAndZero(dAmt) == false) {
				            alert("The donation amount should be bigger than 0.");
				            return false;
				        } else if (validateNumeric(dAmt) == true) {
				            var numdAmt = dAmt;
				            numdAmt = numdAmt.replace(',', '');
				            while (numdAmt.indexOf(',') != -1) {
				                numdAmt = numdAmt.replace(',', '');
				            }
				            numdAmt = numdAmt.split('.');
				            if (numdAmt[0].length > 13) {
				                alert('Your donation amount is too large.');
				                return false;
				            }
				        }
				    }
				    return true;
				}

				function associateToggle(val, elem) {
				    var elem = document.getElementById(elem);
				    if (elem == null) return;
				    if (val == 1) {
				        elem.style.display = "";
				    } else if (val == 0) {
				        elem.style.display = "none";
				    }
				}
				associateToggle(0, 'recurringDonation.recurringInterval1');
				</SCRIPT><!--NEON FORM END-->  
			</div>
		</div>
	</div>
</div>

</div><!-- #page -->

<?php
	if ( is_active_sidebar( 'before-footer' ) ) {
		get_template_part( 'partials/footer', 'before-footer-widget-area' );
	}

    /**
     * Fires before the Largo footer content.
     *
     * @since 0.4
     */
	do_action( 'largo_before_footer' );
?>

<div class="footer-bg clearfix nocontent">
	<footer id="site-footer">

		<?php
		    /**
		     * Fires before the Largo footer widgets appear.
		     *
		     * @since 0.4
		     */
			do_action( 'largo_before_footer_widgets' );

			get_template_part( 'partials/footer', 'widget-area' );

		    /**
		     * Fires before the Largo footer boilerplate content.
		     *
		     * @since 0.4
		     */
			do_action( 'largo_before_footer_boilerplate' );

			get_template_part( 'partials/footer', 'boilerplate' );

		    /**
		     * Fires just before the Largo footer content ends.
		     *
		     * @since 0.4
		     */
			do_action( 'largo_before_footer_close' );
		?>

	</footer>
</div>

<?php
	/**
	 * Fires after the Largo footer content.
	 *
	 * @since 0.4
	 */
	do_action( 'largo_after_footer' );

	wp_footer();
?>

<script>
//Allow clicking instead of hover for dropdown menus
jQuery(document).ready( function($){

    $('#main-nav.navbar .nav>li').click( function(event){
    	var $this;
        event.stopPropagation();
        $this.find('.dropdown-menu').toggle();
    });

    $(document).click( function(){
        $('#main-nav.navbar .nav>li .dropdown-menu').hide();
    });

});
</script>

</body>
</html>
