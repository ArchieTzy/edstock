<div class="login-box">
    <div class="login-logo">
        <?= $this->Html->image('logo.png',['alt'=>'',
            'class'=>'brand-image img-circle elevation-3','style'=>'opacity:0.8', 'width'=>'100', 'height'=>'100'])
            ?>
            <br>
            <b>EdStock</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to continue</p>
                <div class="text-center"><?= $this->Flash->render() ?></div>
                <?= $this->Form->create(null,['templates'=>['inputContainer' => '{{content}}']]) ?>
                <div class="input-group mb-3">
                    <?= $this->Form->control('username',['type'=>'text','class'=>'form-control','placeholder'=>'Username','label'=>false]) ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <?= $this->Form->control('password',['class'=>'form-control','placeholder'=>'Password','label'=>false]) ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= $this->Form->end() ?>
            <!-- <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
