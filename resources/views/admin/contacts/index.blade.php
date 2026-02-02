@extends('layouts.admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-smoke">Liên hệ</p>
            <h2 class="text-3xl font-semibold">Danh sách liên hệ</h2>
        </div>
    </div>

    <div class="mt-6 overflow-hidden rounded-3xl border border-line bg-white/80">
        <table class="w-full text-sm">
            <thead class="bg-[rgba(17,20,24,0.04)] text-xs uppercase tracking-[0.2em] text-smoke">
                <tr>
                    <th class="px-4 py-3 text-left">Khách hàng</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">SĐT</th>
                    <th class="px-4 py-3 text-left">Nội dung</th>
                    <th class="px-4 py-3 text-right">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr class="border-t border-line">
                        <td class="px-4 py-3 font-medium">{{ $contact->name ?? 'Khách' }}</td>
                        <td class="px-4 py-3 text-smoke">{{ $contact->email }}</td>
                        <td class="px-4 py-3 text-smoke">{{ $contact->phone ?? '-' }}</td>
                        <td class="px-4 py-3 text-smoke">{{ \Illuminate\Support\Str::limit($contact->message, 60) }}</td>
                        <td class="px-4 py-3 text-right">
                            <form method="post" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Xóa liên hệ này?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-smoke">Chưa có liên hệ.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $contacts->links() }}
    </div>
@endsection
