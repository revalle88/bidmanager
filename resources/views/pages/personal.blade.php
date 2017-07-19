Личные данные
   @foreach ($logins->data as $login)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $login->Login }}</div>
                                </td>

                                <td>
                                    <!-- TODO: Delete Button -->
                                </td>
                            </tr>
    @endforeach