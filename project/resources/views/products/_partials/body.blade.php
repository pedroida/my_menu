<td>
    <img :src="item.thumbnail" :alt="item.name" class="img-thumbnail" style="max-width: 100px;max-height: 100px;">
</td>
<td>@{{ item.name }}</td>
<td>@{{ item.description }}</td>
<td>R$@{{ item.price }}</td>
<td>@{{ item.created_at }}</td>
<td class="text-center">
    @include('shared.buttons_actions')
</td>
