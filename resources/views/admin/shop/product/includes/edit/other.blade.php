<style>
    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px !important;
    }
</style>

<div class="m-3 col-lg-3">
    <input type="checkbox" name="is_trend" id="is_trend" {{isset($item) && $item->is_trend ? 'checked' : ''}}>
    <label for="is_trend">Trendlere Ekle</label>
</div>

<div class="m-3 col-lg-3">
    <label for="cargo_day">Kargo Süresi Kaç iş günü? (Varsayılan değer: 3 iş günü)</label>
    <input type="number" class="form-control" name="cargo_day" id="cargo_day" value="{{ $item->cargo_day ?? ''}}">
</div>

<div class="m-3 col-lg-3">
    <label for="cargo_company">Kargo firması: </label>
    <select name="cargo_company" id="cargo_company" style="width: 100%;" >
        @if (isset($cargo_company))
            <option value="{{ $cargo_company->code }}" selected>
                <span> <img class="rounded-circle header-profile-user" src="{{url($cargo_company->optional)}}" alt="cargo_image" style="width:30px; height:30px; margin-right: 10px;" /> {{ $cargo_company->value }} </span>
            </option>
        @endif
    </select>
</div>



<script>
   function configCargoCompany(){
    $('#cargo_company').select2({
        ajax: {
            url: '{{ route('admin_shop_cargo_company_get_data') }}',
            dataType: 'json',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: function(params) {
                return {
                    search: params.term,
                    page: 1,
                };
            },
            processResults: function(response) {
                return {
                    results: $.map(response.items, function(item) {
                        return {
                            id: item.code,
                            text: item.value,
                            image: item.optional
                        };
                    }),
                    pagination: {
                        more: response.page_count > 1
                    }
                };
            },
            cache: true
        },
        placeholder: 'Kargo Firması Ara...',
        minimumInputLength: 3,
        escapeMarkup: function(markup) {
            return markup;
        },
        templateResult: formatResult,
        templateSelection: formatSelection
    });

    function formatResult(item) {
        if (!item.id) return item.text;

        var imageMarkup = '';
        if(item.image){
            imageMarkup = `<img class="rounded-circle header-profile-user" src="../../../../${item.image}" alt="cargo_image" style="width:30px; height:30px; margin-right: 10px;" />`;
        }

        return $('<span>' + imageMarkup + item.text + '</span>');
    }

    function formatSelection(item) {
        if (!item.id) return item.text;

        var imageMarkup = '';
        if(item.image){
            imageMarkup = `<img class="rounded-circle header-profile-user" src="../../../../${item.image}" alt="cargo_image" style="width:30px; height:30px; margin-right: 10px;" />`;
        }

        return $('<span>' + imageMarkup + item.text + '</span>');
    }
}


</script>
