<div>
<div class="p-6 border-t border-gray-200">
    <!-- Блок для отображения Alert -->
    @if (session()->has('message'))
    <div id="alert" class="mt-2 mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
        <p>{{ session('message') }}</p>
    </div>
    @endif
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Адрес Документа</h3>
    <form wire:submit="saveDocument" class="space-y-4">
        <div class="flex items-center gap-4">
            <!-- Поле для ввода ссылки с фиксированной частью -->
            <div class="flex-grow flex items-center">
                <div class="bg-gray-100 px-3 py-2 border border-gray-300 rounded-l-md shadow-sm">
                    <span class="text-gray-700">https://docs.google.com/spreadsheets/d/</span>
                </div>
                <input
                    type="text"
                    wire:model="spreadsheet_id"
                    class="flex-grow px-3 py-2 border-t border-b border-r border-gray-300 rounded-r-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Введите уникальную часть ссылки"
                    required
                />
            </div>
            <!-- Поле для ввода названия листа -->
            <div class="w-1/3">
                <label for="sheetName" class="sr-only">Название листа</label>
                <input
                    type="text"
                    wire:model="sheet_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Введите название листа"
                    required
                />
            </div>

            <!-- Кнопка "Сохранить" -->
            <div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Сохранить
                </button>
            </div>
        </div>
    </form>
</div>
<!-- Форма добавления нового пользователя -->
<div class="p-6 border-t border-gray-200">
    <form wire:submit="saveUser" class="space-y-4">
        <!-- Поле "Имя" -->
        <div>
            <label for="firstName" class="block text-sm font-medium text-gray-700">Имя</label>
            <input
                type="text"
                wire:model="first_name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Введите имя"
                required
            />
        </div>

        <!-- Поле "Фамилия" -->
        <div>
            <label for="lastName" class="block text-sm font-medium text-gray-700">Фамилия</label>
            <input
                type="text"
                 wire:model="last_name"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Введите фамилию"
                required
            />
        </div>

        <!-- Поле "Статус" -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Статус</label>
            <select
                wire:model="status"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                required
            >
                <option value="allowed">Активен</option>
                <option value="prohibited" selected>Неактивен</option>
            </select>
            @error('status') <span class="error">{{ $message }}</span> @enderror 
        </div>

        <!-- Кнопка отправки формы -->
        <div class="flex justify-start">
            <button
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                @if($current_id) Изменить @else Добавить @endif
            </button>
        </div>
    </form>
</div>
<div class="flex flex-col border-t border-gray-200">
    @if (session()->has('clear'))
    <div id="alert" class="mt-2 mx-6 mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
        <p>{{ session('clear') }}</p>
    </div>
    @endif
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
        <div class="overflow-hidden">
            <table wire:poll.15s="sync" class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                @foreach($sheets[0] as $h)
                <th scope="col" class="px-6 py-4">{{ $h }}</th>
                @endforeach
                <th scope="col" class="px-6 py-4">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach(array_slice($sheets, 1) as $key => $row)
                <tr class="border-b dark:border-neutral-500">
                    @foreach($row as $col)
                    <td class="whitespace-nowrap px-6 py-4">{{ $col }}</td>
                    @endforeach
                    <td class="whitespace-nowrap px-6 py-4">
                    <div class="flex items-center gap-2">
                        <!-- Кнопка "Редактировать" -->
                        <button
                            wire:click="editUser({{ $key + 1 }})"
                            class="p-2 text-indigo-600 hover:text-indigo-900 focus:outline-none"
                            title="Редактировать"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </button>

                        <!-- Кнопка "Удалить" -->
                        <button
                            wire:confirm="Вы хотите удалить пользователя?"
                            wire:click="deleteUser({{ $key + 1}})"
                            class="p-2 text-red-600 hover:text-red-900 focus:outline-none"
                            title="Удалить"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
    <!-- Кнопка "Очистить таблицу" -->
    <div class="flex justify-end p-6">
        <button
            wire:confirm="Вы хотите очистить таблицу?"
            wire:click="clearTable"
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
        >
            Очистить таблицу
        </button>
    </div>
</div>
</div>