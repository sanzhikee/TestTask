<?php
/**
 * @var User[] $users
 * @var User $model
 * @var Controller $this
 */
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1>Welcome</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                ut aliquip ex ea commodo consequat.</p>

            <a class="btn btn-danger" href="<?=Yii::app()->createUrl('/site/logout')?>">
                Выйти
            </a>
            <hr>

            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Добавить пользователя
            </button>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Username</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->first_name ?></td>
                        <td><?= $user->second_name ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $this->statuses[$user->status] ?></td>
                        <td>
                            <a class="btn btn-info" href="#" data-toggle="modal" data-target="#myModal<?=$user->id?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a class="btn btn-danger"
                               href="<?= Yii::app()->createUrl('/admin/delete', ['id' => $user->id]); ?>">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div id="myModal<?=$user->id?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <?php $form = $this->beginWidget('CActiveForm', array(
                                    'action' => ['/admin/update', 'id' => $user->id],
                                    'id' => 'update-form'.$user->id,
                                    'enableClientValidation' => true,
                                    'enableAjaxValidation' => true,
                                    'clientOptions' => array(
                                        'validateOnSubmit' => true,
                                    ),
                                )); ?>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Изменить пользователя</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <?php echo $form->labelEx($user, 'username'); ?>
                                        <?php echo $form->textField($user, 'username', ['class' => 'form-control', 'id' => 'username'.$user->id]); ?>
                                        <?php echo $form->error($user, 'username'); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($user, 'first_name'); ?>
                                        <?php echo $form->textField($user, 'first_name', ['class' => 'form-control', 'id' => 'first_name'.$user->id]); ?>
                                        <?php echo $form->error($user, 'first_name'); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($user, 'second_name'); ?>
                                        <?php echo $form->textField($user, 'second_name', ['class' => 'form-control', 'id' => 'second_name'.$user->id]); ?>
                                        <?php echo $form->error($user, 'second_name'); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($user, 'email'); ?>
                                        <?php echo $form->textField($user, 'email', ['class' => 'form-control', 'type' => 'email', 'id' => 'email'.$user->id]); ?>
                                        <?php echo $form->error($user, 'email'); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($user, 'status'); ?>
                                        <?php echo $form->dropDownList($user, 'status', $this->statuses,['class' => 'form-control', 'id' => 'status'.$user->id]); ?>
                                        <?php echo $form->error($user, 'status'); ?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $form->labelEx($user, 'new_password'); ?>
                                        <?php echo $form->passwordField($user, 'new_password', ['class' => 'form-control', 'id' => 'new_password'.$user->id]); ?>
                                        <?php echo $form->error($user, 'new_password'); ?>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <?php echo CHtml::submitButton('Изменить', ['class' => 'btn btn-success']); ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                </div>
                                <?php $this->endWidget(); ?>
                            </div>

                        </div>
                    </div>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => '/admin/create',
                'id' => 'form',
                'enableClientValidation' => true,
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавить пользователя</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'username'); ?>
                    <?php echo $form->textField($model, 'username', ['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'first_name'); ?>
                    <?php echo $form->textField($model, 'first_name', ['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'first_name'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'second_name'); ?>
                    <?php echo $form->textField($model, 'second_name', ['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'second_name'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email', ['class' => 'form-control', 'type' => 'email']); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'status'); ?>
                    <?php echo $form->dropDownList($model, 'status', $this->statuses,['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'status'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', ['class' => 'form-control']); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>

            </div>
            <div class="modal-footer">
                <?php echo CHtml::submitButton('Добавить', ['class' => 'btn btn-success']); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
            <?php $this->endWidget(); ?>
        </div>

    </div>
</div>