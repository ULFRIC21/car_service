

<?php $__env->startSection('title', 'Вход'); ?>

<?php $__env->startSection('content'); ?>
<div class="landing-container auth-box">
    <h1 class="auth-box__title">Вход</h1>

    <?php if($errors->any()): ?>
        <ul class="auth-box__errors">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>" class="auth-box__form">
        <?php echo csrf_field(); ?>

        <label class="auth-box__label" for="email">Email</label>
        <input id="email" type="email" class="auth-box__input" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

        <label class="auth-box__label" for="password">Пароль</label>
        <input id="password" type="password" class="auth-box__input" name="password" required>

        <label class="auth-box__remember">
            <input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
            Запомнить меня
        </label>

        <button type="submit" class="auth-box__btn">Войти</button>
    </form>

    <?php if(Route::has('password.request')): ?>
        <p class="auth-box__footer"><a href="<?php echo e(route('password.request')); ?>">Забыли пароль?</a></p>
    <?php endif; ?>

    <p class="auth-box__footer">
        Нет аккаунта? <a href="<?php echo e(route('register')); ?>">Регистрация</a>
    </p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/auth/login.blade.php ENDPATH**/ ?>