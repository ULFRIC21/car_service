

<?php $__env->startSection('title', 'Регистрация'); ?>

<?php $__env->startSection('content'); ?>
<div class="landing-container auth-box">
    <h1 class="auth-box__title">Регистрация</h1>

    <?php if($errors->any()): ?>
        <ul class="auth-box__errors">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('register')); ?>" class="auth-box__form">
        <?php echo csrf_field(); ?>

        <label class="auth-box__label" for="last_name">Фамилия</label>
        <input id="last_name" type="text" class="auth-box__input" name="last_name" value="<?php echo e(old('last_name')); ?>" required autofocus>

        <label class="auth-box__label" for="first_name">Имя</label>
        <input id="first_name" type="text" class="auth-box__input" name="first_name" value="<?php echo e(old('first_name')); ?>" required>

        <label class="auth-box__label" for="patronymic">Отчество</label>
        <input id="patronymic" type="text" class="auth-box__input" name="patronymic" value="<?php echo e(old('patronymic')); ?>">

        <label class="auth-box__label" for="phone">Телефон</label>
        <input id="phone" type="text" class="auth-box__input" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="8 800 535 353">

        <label class="auth-box__label" for="email">Email</label>
        <input id="email" type="email" class="auth-box__input" name="email" value="<?php echo e(old('email')); ?>" required>

        <label class="auth-box__label" for="password">Пароль</label>
        <input id="password" type="password" class="auth-box__input" name="password" required>

        <label class="auth-box__label" for="password-confirm">Подтверждение пароля</label>
        <input id="password-confirm" type="password" class="auth-box__input" name="password_confirmation" required>

        <button type="submit" class="auth-box__btn">Зарегистрироваться</button>
    </form>

    <p class="auth-box__footer">
        Уже есть аккаунт? <a href="<?php echo e(route('login')); ?>">Войти</a>
    </p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/auth/register.blade.php ENDPATH**/ ?>