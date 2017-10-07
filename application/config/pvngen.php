<?php

$config['field_wraps'] = array(
			'hidden' => '<input type="hidden"  name="{name}" id="{id}" value="{val}"  />',
			'simple' => '<div class="form-group row">
							<div class="col-md-3">
								<label class="form-control-label" for="{id}">{label}</label>
							</div>
							<div class="col-md-9">
								<input {required} type="{type}" class="form-control" name="{name}" id="{id}" value="{val}" {attributes} />
							</div>
						</div>',
			'select' => '<div class="form-group row">
							<div class="col-md-3">
								<label class="form-control-label" for="{id}">{label}</label>
							</div>
							<div class="col-md-9">
								<select class="form-control" name="{name}" id="{id}"><option value="0">-Select-</option>{options}</select>
							</div>
						</div>',
			'textarea' => '<div class="form-group row">
							<div class="col-md-3">
								<label class="form-control-label" for="{id}">{label}</label>
							</div>
							<div class="col-md-9">
								<textarea class="form-control" name="{name}" id="{id}">{val}</textarea>
							</div>
						</div>',
			'file' => '<div class="form-group row">
						<div class="col-md-3">
							<label class="form-control-label" for="{id}">{label}</label>
						</div>
						<div class="col-md-9">
							<input type="file" class="" name="{name}" id="{id}" >
						</div>
					</div>',

);
