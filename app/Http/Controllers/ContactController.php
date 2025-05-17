<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'nullable|string',
            'product_id' => 'nullable|exists:products,id',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.string' => 'Họ tên không hợp lệ.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',

            'email.string' => 'Email không hợp lệ.',
            'email.email' => 'Email phải đúng định dạng (ví dụ: ten@email.com).',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.string' => 'Số điện thoại không hợp lệ.',
            'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',

            'message.string' => 'Nội dung tin nhắn không hợp lệ.',

            'product_id.exists' => 'Sản phẩm không tồn tại.',
        ]);

        try {

            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'product_id' => $request->product_id,
                'message' => $request->message,
                'is_read' => false
            ]);

            return redirect()->back()->with('success', 'Liên hệ của bạn đã được gửi thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::with('product')->findOrFail($id);

        return view('admin.contacts.detail', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function seen(string $id)
    {
        $contact = Contact::findOrFail($id);

        $contact->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Đã đổi liên hệ thành đã xem');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()
            ->with('success', 'Tin nhắn liên đã được xóa thành công');
    }
}
