<div class="ibox-content">
				<div class="form-group row {{ $errors->has('header_script') ? 'has-error' : '' }}">
					<label class="col-sm-3 col-form-label">
						<strong>Header Script</strong>
						<span class="text-danger">*</span>
					</label>
					<div class="col-sm-9">
						{!! Form::textarea('header_script',null,[
						'class' => 'form-control ',
						'id'	=> 'header_script'
						]) !!}
						<span class="help-block">
							<font color="red"> {{ $errors->has('header_script') ? "".$errors->first('header_script')."" : '' }} </font>
						</span>
					</div>
				</div>

				<div class="form-group row {{ $errors->has('body_script') ? 'has-error' : '' }}">
					<label class="col-sm-3 col-form-label">
						<strong>Body Script</strong>
						<span class="text-danger">*</span>
					</label>
					<div class="col-sm-9">
						{!! Form::textarea('body_script',null,[
						'class' => 'form-control ',
						'id'	=> 'body_script'
						]) !!}
						<span class="help-block">
							<font color="red"> {{ $errors->has('body_script') ? "".$errors->first('body_script')."" : '' }} </font>
						</span>
					</div>
				</div>

				<div class="form-group row {{ $errors->has('footer_script') ? 'has-error' : '' }}">
					<label class="col-sm-3 col-form-label">
						<strong>Footer Script</strong>
						<span class="text-danger">*</span>
					</label>
					<div class="col-sm-9">
						{!! Form::textarea('footer_script',null,[
						'class' => 'form-control ',
						'id'	=> 'footer_script'
						]) !!}
						<span class="help-block">
							<font color="red"> {{ $errors->has('footer_script') ? "".$errors->first('footer_script')."" : '' }} </font>
						</span>
					</div>
				</div>
			</div>
