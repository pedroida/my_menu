<tr>
    <th sortable @click="orderBy('name', $event)" style="width: 35%">
        @lang('labels.common.name')
    </th>

    <th sortable @click="orderBy('created_at', $event)" style="width: 15%">
        @lang('labels.common.created_at')
    </th>
    <th class="text-center" style="width: 15%">
        @lang('labels.common.actions')
    </th>
</tr>
