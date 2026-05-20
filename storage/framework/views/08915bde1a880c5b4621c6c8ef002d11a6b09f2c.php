<div class="mb-2">
    <label>Название *</label>
    <input type="text" name="name" class="form-control" value="<?php echo e(old('name', $service->name ?? '')); ?>" required>
</div>
<div class="mb-2">
    <label>Описание</label>
    <textarea name="description" class="form-control" rows="2"><?php echo e(old('description', $service->description ?? '')); ?></textarea>
</div>
<div class="mb-2">
    <label>Цена *</label>
    <input type="number" step="0.01" min="0" name="price" class="form-control" value="<?php echo e(old('price', $service->price ?? '')); ?>" required>
</div>
<div class="mb-2">
    <label>Длительность (мин) *</label>
    <input type="number" min="15" max="480" name="duration_minutes" class="form-control" value="<?php echo e(old('duration_minutes', $service->duration_minutes ?? 60)); ?>" required>
</div>
<div class="mb-2 form-check">
    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
        <?php echo e(old('is_active', $service->is_active ?? true) ? 'checked' : ''); ?>>
    <label class="form-check-label" for="is_active">Активна</label>
</div>
<?php /**PATH C:\Program Files\Ampps\www\car_service\resources\views/admin/services/_form.blade.php ENDPATH**/ ?>