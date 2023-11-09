<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <div class="p-3 control-sidebar-content">
        <?php if ($this->request->getSession()->check('Auth.User')) : ?>
        <a><h5><?= h($this->request->getSession()->read('Auth.User.fullname')) ?></h5></a>
    <?php endif; ?>
    <hr class="mb-2" style="background-color: grey;">
    <div class="mb-3">
        <?= $this->Html->link('<i class="fa fas fa-sign-out-alt"></i>
         <span>Logout
         </span>', '/users/logout', ['escape' => false]) ?>
     </div>
 </div>
</aside>
