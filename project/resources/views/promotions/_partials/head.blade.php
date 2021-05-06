<tr>
    <th sortable @click="orderBy('name', $event)">
        @lang('labels.common.name')
    </th>

    <th sortable @click="orderBy('valid_from', $event)">
        Válido de
    </th>

    <th sortable @click="orderBy('valid_until', $event)">
        Válido até
    </th>

    <th sortable @click="orderBy('type', $event)">
        Tipo
    </th>

    <th sortable @click="orderBy('value', $event)">
        Valor/%
    </th>

    <th>
        Quant. produtos
    </th>

    <th sortable @click="orderBy('created_at', $event)" style="width: 15%">
        @lang('labels.common.created_at')
    </th>

    <th class="text-center" style="width: 15%">
        @lang('labels.common.actions')
    </th>
</tr>
