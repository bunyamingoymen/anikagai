<div class="m-3 col-lg-3">
    <input type="checkbox" name="is_trend" id="is_trend" {{isset($item) && $item->is_trend ? 'checked' : ''}}>
    <label for="trend">Trendlere Ekle</label>
</div>

<div class="m-3 col-lg-3">
    <label for="trend">Kargo Süresi Kaç iş günü? (Varsayılan değer: 3 iş günü)</label>
    <input type="number" class="form-control" name="cargo_day" id="cargo_day" value="{{ $item->cargo_day ?? ''}}">
</div>
