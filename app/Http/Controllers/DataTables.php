<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataTables extends Controller
{
    public function index(Request $request)
    {
        $data = [
            ['id' => 1, 'name' => 'Item 1', 'category' => 'Category 1'],
            ['id' => 2, 'name' => 'Item 2', 'category' => 'Category 2'],
            ['id' => 3, 'name' => 'Item 3', 'category' => 'Category 3'],
            ['id' => 4, 'name' => 'Item 4', 'category' => 'Category 1'],
            ['id' => 5, 'name' => 'Item 5', 'category' => 'Category 2'],
            ['id' => 6, 'name' => 'Item 6', 'category' => 'Category 3'],
            ['id' => 7, 'name' => 'Item 7', 'category' => 'Category 1'],
            ['id' => 8, 'name' => 'Item 8', 'category' => 'Category 2'],
            ['id' => 9, 'name' => 'Item 9', 'category' => 'Category 3'],
            ['id' => 10, 'name' => 'Item 10', 'category' => 'Category 1'],
            ['id' => 1, 'name' => 'Item 1', 'category' => 'Category 1'],
            ['id' => 2, 'name' => 'Item 2', 'category' => 'Category 2'],
            ['id' => 3, 'name' => 'Item 3', 'category' => 'Category 3'],
            ['id' => 4, 'name' => 'Item 4', 'category' => 'Category 1'],
            ['id' => 5, 'name' => 'Item 5', 'category' => 'Category 2'],
            ['id' => 6, 'name' => 'Item 6', 'category' => 'Category 3'],
            ['id' => 7, 'name' => 'Item 7', 'category' => 'Category 1'],
            ['id' => 8, 'name' => 'Item 8', 'category' => 'Category 2'],
            ['id' => 9, 'name' => 'Item 9', 'category' => 'Category 3'],
            ['id' => 10, 'name' => 'Item 10', 'category' => 'Category 1'],
            ['id' => 1, 'name' => 'Item 1', 'category' => 'Category 1'],
            ['id' => 2, 'name' => 'Item 2', 'category' => 'Category 2'],
            ['id' => 3, 'name' => 'Item 3', 'category' => 'Category 3'],
            ['id' => 4, 'name' => 'Item 4', 'category' => 'Category 1'],
            ['id' => 5, 'name' => 'Item 5', 'category' => 'Category 2'],
            ['id' => 6, 'name' => 'Item 6', 'category' => 'Category 3'],
            ['id' => 7, 'name' => 'Item 7', 'category' => 'Category 1'],
            ['id' => 8, 'name' => 'Item 8', 'category' => 'Category 2'],
            ['id' => 9, 'name' => 'Item 9', 'category' => 'Category 3'],
            ['id' => 10, 'name' => 'Item 10', 'category' => 'Category 1'],
        ];

        return response()->json($data);
    }

    public function show($id)
{
    // Data statis
    $data = [
        ['id' => 1, 'name' => 'Item 1', 'category' => 'Category 1', 'description' => 'Description for Item 1'],
        ['id' => 2, 'name' => 'Item 2', 'category' => 'Category 2', 'description' => 'Description for Item 2'],
        ['id' => 3, 'name' => 'Item 3', 'category' => 'Category 3', 'description' => 'Description for Item 3'],
        ['id' => 4, 'name' => 'Item 4', 'category' => 'Category 1', 'description' => 'Description for Item 4'],
        ['id' => 5, 'name' => 'Item 5', 'category' => 'Category 2', 'description' => 'Description for Item 5'],
        ['id' => 6, 'name' => 'Item 6', 'category' => 'Category 3', 'description' => 'Description for Item 6'],
        ['id' => 7, 'name' => 'Item 7', 'category' => 'Category 1', 'description' => 'Description for Item 7'],
        ['id' => 8, 'name' => 'Item 8', 'category' => 'Category 2', 'description' => 'Description for Item 8'],
        ['id' => 9, 'name' => 'Item 9', 'category' => 'Category 3', 'description' => 'Description for Item 9'],
        ['id' => 10, 'name' => 'Item 10', 'category' => 'Category 1', 'description' => 'Description for Item 10'],
        ['id' => 11, 'name' => 'Item 11', 'category' => 'Category 2', 'description' => 'Description for Item 11'],
    ];

    // Cari data berdasarkan ID
    $item = collect($data)->firstWhere('id', $id);

    // Jika item tidak ditemukan, kembalikan respons dengan pesan error
    if (!$item) {
        return response()->json(['error' => 'Item not found'], 404);
    }

    // Kembalikan data item
    return response()->json($item);
}
}
