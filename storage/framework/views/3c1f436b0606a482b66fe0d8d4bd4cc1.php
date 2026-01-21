<div class="support-form-container">
    <form action="<?php echo e(route('contact.submit')); ?>" method="POST" class="vist-contact-form" novalidate>
        <?php echo csrf_field(); ?>
        
        <div class="form-group">
            <label for="name">Ім'я <span class="required">*</span></label>
            <input type="text" id="name" name="name" required placeholder="Ваше ім'я" value="<?php echo e(old('name')); ?>">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <div class="form-group">
            <label for="email">Email <span class="required">*</span></label>
            <input type="email" id="email" name="email" autocomplete="email" required placeholder="name@company.com" value="<?php echo e(old('email')); ?>">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <div class="form-group">
            <label for="phone">Телефон <span class="required">*</span></label>
            <input type="tel" id="phone" name="phone" required placeholder="+38 (0XX) XXX-XX-XX" value="<?php echo e(old('phone')); ?>">
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <?php if($showSubject ?? true): ?>
        <div class="form-group">
            <label for="subject">Тема звернення <span class="required">*</span></label>
            <select id="subject" name="subject" required>
                <option value="">Оберіть тему...</option>
                <option value="consultation" <?php echo e(old('subject') == 'consultation' ? 'selected' : ''); ?>>Технічна консультація</option>
                <option value="order" <?php echo e(old('subject') == 'order' ? 'selected' : ''); ?>>Питання щодо замовлення</option>
                <option value="warranty" <?php echo e(old('subject') == 'warranty' ? 'selected' : ''); ?>>Гарантійне обслуговування</option>
                <option value="repair" <?php echo e(old('subject') == 'repair' ? 'selected' : ''); ?>>Ремонт обладнання</option>
                <option value="configuration" <?php echo e(old('subject') == 'configuration' ? 'selected' : ''); ?>>Підбір конфігурації</option>
                <option value="other" <?php echo e(old('subject') == 'other' ? 'selected' : ''); ?>>Інше питання</option>
            </select>
            <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label for="message">Повідомлення <span class="required">*</span></label>
            <textarea id="message" name="message" rows="6" minlength="10" required placeholder="Детально опишіть ваше питання..."><?php echo e(old('message')); ?></textarea>
            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <!-- Honeypot для захисту від спаму -->
        <div style="position: absolute; left: -9999px;">
            <input type="text" name="company" tabindex="-1" autocomplete="off">
        </div>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-error">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        
        <button type="submit" class="btn-submit-support">
            📨 Відправити звернення
        </button>
        
        <?php if($showNote ?? true): ?>
        <p style="text-align: center; color: #7f8c8d; font-size: 14px; margin-top: 15px;">
            <?php echo e($note ?? 'Ми зв\'яжемося з вами найближчим часом.'); ?>

        </p>
        <?php endif; ?>
    </form>
</div><?php /**PATH C:\Users\liqwood\Herd\vist-laravel\resources\views/components/contact-form.blade.php ENDPATH**/ ?>