<?php
/**
 * @var \app\models\User[] $users
 * @var \app\models\User $model
 * @var \yii\web\View $this
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

            <a class="btn btn-danger" href="<?= \yii\helpers\Url::to(['/site/logout']) ?>">
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
                        <td><?= $user->status ?></td>
                        <td>
                            <a class="btn btn-info" href="#" data-toggle="modal" data-target="#myModal<?= $user->id ?>">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a class="btn btn-danger"
                               href="<?= \yii\helpers\Url::to(['/admin/delete', 'id' => $user->id]) ?>">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal -->
                    <div id="myModal<?= $user->id ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <?php $form = \yii\widgets\ActiveForm::begin([
                                    'id' => 'update-form'.$user->id,
                                    'action' => ['/admin/update', 'id' => $user->id],
                                    'enableClientValidation' => true,
                                    'enableAjaxValidation' => true,
                                ]); ?>

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Изменить пользователя</h4>
                                </div>
                                <div class="modal-body">
                                    <?= $form->field($user, 'username')->textInput(['id' => 'username'.$user->id]) ?>
                                    <?= $form->field($user, 'first_name')->textInput(['id' => 'first_name'.$user->id]) ?>
                                    <?= $form->field($user, 'second_name')->textInput(['id' => 'second_name'.$user->id]) ?>
                                    <?= $form->field($user, 'email')->textInput(['id' => 'email'.$user->id]) ?>
                                    <?= $form->field($user, 'status')->dropDownList(\app\models\User::STATUSES, ['id' => 'status'.$user->id]) ?>
                                    <?= $form->field($user, 'new_password')->passwordInput(['id' => 'new_password'.$user->id]) ?>
                                </div>

                                <div class="modal-footer">
                                    <?php echo \yii\helpers\Html::submitButton('Изменить', ['class' => 'btn btn-success']); ?>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                                </div>
                                <?php \yii\widgets\ActiveForm::end(); ?>
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
            <?php $form = \yii\widgets\ActiveForm::begin([
                'id' => 'create-form',
                'action' => ['/admin/create'],
                'enableClientValidation' => true,
                'enableAjaxValidation' => true,
            ]); ?>

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Добавить пользователя</h4>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'first_name')->textInput() ?>
                <?= $form->field($model, 'second_name')->textInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?= $form->field($model, 'status')->dropDownList(\app\models\User::STATUSES) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>

            <div class="modal-footer">
                <?php echo \yii\helpers\Html::submitButton('Добавить', ['class' => 'btn btn-success']); ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>

    </div>
</div>