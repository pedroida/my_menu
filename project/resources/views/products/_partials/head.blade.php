<tr>
    <th>
        @lang('labels.common.thumb')
    </th>
    <th sortable @click="orderBy('name', $event)">
        @lang('labels.common.name')
    </th>

    <th sortable @click="orderBy('description', $event)">
        @lang('labels.common.description')
    </th>

    <th sortable @click="orderBy('price', $event)">
        @lang('labels.common.price')
    </th>

    <th sortable @click="orderBy('created_at', $event)" style="width: 15%">
        @lang('labels.common.created_at')
    </th>
    <th class="text-center" style="width: 15%">
        @lang('labels.common.actions')
    </th>
</tr>
