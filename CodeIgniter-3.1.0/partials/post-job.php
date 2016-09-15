<?php if (isset($_COOKIE['user_identifier'])){?>
<section>

	<!-- JOB-POST FORM -->
	<div class="row">
		<div class="col-md-11">
			<form class="form-horizontal" id="job-post-form"  action="http://www.cs.tut.fi/cgi-bin/run/~jkorpela/echo.cgi" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label class="control-label col-sm-2">YOUR ACCOUNT</label>
					<div class="col-sm-10">
						<input type="input" class="form-control" id="your-account-id" disabled value="{{getDataFactory.display_name}}">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">JOB TITLE</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="job-title-id" maxlength="30" placeholder="Enter the title of job.....">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" type="email">APPLICATION EMAIL</label>
					<div class="col-sm-10"> 
						<!-- APPLY DATABINDING TO PREFILL THE EMAIL -->
						<input type="email" class="form-control" maxlength="40" id="application-email-id" placeholder="" ng-pattern="emailFormat" ng-model="text" required>
						<div id="validation-message"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">LOCATION(Optional)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="location-id" maxlength="30" placeholder="For Example India..">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">JOB TYPE</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="job-type-id" maxlength="30" placeholder="Enter the title of job.....">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">JOB TAG</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="job-tag-id" placeholder="For Example PHP, Managment, Social Media...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">FEATURED IMAGE(Otional)</label>
					<div class="col-sm-10"> 
						<input type="file" id="image-id" name="datafile" size="40">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">DESCRIPTION(OR PROVIDE LINK OF YOUR JOB FROM YOUR COMPANY CAREER PACK)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control textarea" id="description-id" placeholder="">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2"  type="date">CLOSING DATE</label>
					<div class="col-sm-10"> 
						<div class='input-group date' id='datetimepicker1'>
		                    <input type='text' id="closing-date-id" class="form-control" />
		                    <span class="input-group-addon">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
						<p class="closing-date-info">Deadline for new applicants. The listing will end automatically after this date.</p>
					</div>
				</div>
				<h1 id="about-company-id">Company Details</h1>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">COMPANY NAME</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="company-name-id" placeholder="your company name..">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">TAG LINE(Optional)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="tag-line-id" placeholder="Breifly describe your company..">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">DESCRIPTION(Optional)</label>
					<div class="col-sm-10"> 
						<textarea class="form-control" id="company-description-id" placeholder=""></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">VIDEO(Optional)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="video-id" placeholder="A link to a video of your company...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">WEBSITE(Optional)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="company-website-id" placeholder="http//">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">GOOGLE+ USERNAME (OPTIONAL)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="google-username-id" placeholder="Yourcompany...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">FACEBOOK USERNAME (OPTIONAL)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="facebook-username-id" placeholder="YourCompany...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">LINKEDIN USERNAME (OPTIONAL)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="linkedin-username-id" placeholder="YourCompany...">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">TWITTER USERNAME (Optional)</label>
					<div class="col-sm-10"> 
						<input type="input" class="form-control" id="twitter-username-id" placeholder="@yourcompany">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2" for="pwd">LOGO (Otional)</label>
					<div class="col-sm-10"> 
						<input type="file" id="logo-id" name="datafile" size="40">
						<p>Maximum file size 128 MB.</p>
					</div>
				</div>	
				<div class="form-group"> 
					<div class="col-sm-offset-2 col-sm-10">
						<a class="btn btn--m" id="preview-id" ng-click="formPreview()">PREVIEW</a>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>

	<!-- DIALOG BOX FOR FORM PREVIEW -->
	<div class="modal fade" id="formPreview" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
		    	<div class="modal-header">
		    		<button type="button" class="close" data-dismiss="modal">&times;</button>
		      		<h2 class="modal-title">PREVIEW</h2>
		    	</div>
		    	<div class="modal-body">	
		    		<div class="row">
		    			<div class="row" id="title-row">
		    				<div class="col-md-12" id="job-title"></div>
		    			</div>
		    			<div class="row" id="input-info-row">
		    				<div class="col-md-2" id="job-type"></div>
		    				<div class="col-md-2" id="job-tag"></div>
		    				<div class="col-md-2" id="location"></div>
		    				<div class="col-md-2" id="post-time">posting time here</div>
		    				<div class="col-md-2" id="closing-date"></div>
		    				<div class="col-md-2" id="company-name"></div>
		    			</div>
		    		</div>
		    		<div class="row" id="company-details-row">
		    			<div class="col-md-4">
		    				<img id="image" width="200px" height="200px"/>
		    			</div>
		    			<div class="col-md-8 sociaLinks">
		    				<div  class="row">
		    					<div id="company-social-details">Company Details</div>
		    				</div>
		    				<a href="http://{{values.email}}" target="_blank" class="row" id="application-email"></a>
		    				<a href="http://plus.google.com/{{values.google}}" target="_blank" class="row" id="google-username"></a>
		    				<a href="http://facebook.com/{{values.facebook}}" target="_blank" class="row" id="facebook-username"></a>
		    				<a href="http://linkedin.com/{{values.linkedin}}" target="_blank" class="row" id="linkedin-username"></a>
		    				<a href="http://twitter.com/{{values.twitter}}" target="_blank" class="row" id="twitter-username"></a>
		    				<a href="{{values.website}}" target="_blank" class="row" id="company-website"></a>
		    			</div>
		    		</div>
		    		<div class="row" id="other-details-row">
		    			<div class="col-md-4">
		    				<img id="logo" width="200px" height="200px">
		    			</div>
		    			<div class="col-md-8">
		    				<div class="row">
		    					<div class="col-md-3" id="overview">Overview</div>
		    				</div>
	    					<div class="row" id="tag-line"></div>
		    				<div class="row" id="description"></div>
		    				<div class="row" id="about-company">About Company</div>
		    				<div class="row sociaLinks">
		    					<a href="http://{{values.video}}" target="_blank" class="row" id="video"></a> 
		    				</div>
		    				<div class="row" id="company-description"></div>
		    			</div>
		    		</div>
		    	</div>

		    	<!-- FOOTER OF DIALOG MODAL -->
			    <div class="modal-footer">
			    	<a class="btn btn--m" id="edit-listing-id" ng-click="editListing()">EDIT LISTING</a>
			    	<a class="btn btn--m" id="submit-listing-id" ng-click="postForm()">SUBMIT LISTING</a>
			    </div>
		  	</div>
		</div>
	</div>

	<!-- POST JOB SUBMITTING CONFERMATION DIALOG MODAL-->
	<div class="modal fade" id="post-job-confirmation-modal" role="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
		    	<div class="modal-header">
		    		<button type="button" class="close" data-dismiss="modal">&times;</button>
		      		<h2 class="modal-title">JOB HAS BEEN POSTED</h2>
		    	</div>
		    	<div class="modal-body">
					<p id="post-job-confirmation-modal-content">
						Your job has been posted successfully. Thank you!
					</p>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>