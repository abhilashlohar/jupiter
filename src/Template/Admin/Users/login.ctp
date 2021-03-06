<?= $this->Form->create($user, ['class' => 'login-form']) ?>
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<!--<i class="fa fa-user"></i>-->
				<?= $this->Form->control('username', ['label' => false, 'class' => 'form-control placeholder-no-fix', 'placeholder' => __(' Username'),'autocomplete'=>'off']) ?>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<!--<i class="fa fa-lock"></i>-->
				<?= $this->Form->control('password', ['label' => false, 'class' => 'form-control placeholder-no-fix', 'placeholder' => __('Password'), 'type' => 'password','autocomplete'=>'off']) ?>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox" style="visibility: hidden;">
			<input type="checkbox" name="remember" value="1"/ > Remember me </label>
			<button type="submit" class="btn blue pull-right">
			Login <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		
		<div class="forget-password">
			 <?= $this->Html->link(__('Forgot Password?'), ['controller' => 'Users', 'action' => 'forgotPassword'], ['class' => 'forget-password']); ?>
		</div>
	<?= $this->Form->end() ?>