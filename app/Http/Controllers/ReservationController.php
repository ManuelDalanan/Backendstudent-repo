<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('book')->get();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $reservation = Reservation::create($request->all());

        if ($request->input('status') === true) {
            DB::table('reserve_books')->insert([
                'request_id' => $reservation->id,
                'book_id' => $reservation->book_id,
            ]);
        }

        return response()->json($reservation, 201);
    }

    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        return response()->json($reservation, 200);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json(null, 204);
    }

    public function reserve(Request $request, $bookId)
    {
        $book = Book::find($bookId);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        if (!$book->available) {
            return response()->json(['error' => 'The book is not available for reservation'], 400);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $book->available = false;
            $book->save();

            $reservation = Reservation::create([
                'user_id' => $request->user_id,
                'book_id' => $bookId,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => true,
            ]);

            if ($reservation->status === true) {
                DB::table('reserve_books')->insert([
                    'request_id' => $reservation->id,
                    'book_id' => $reservation->book_id,
                ]);
            }

            return response()->json($reservation, 201);

        } catch (\Exception $e) {
            Log::error('Error reserving book: ' . $e->getMessage());
            return response()->json(['Error' => 'Failed to reserve the book.'], 500);
        }
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }

        $book = Book::find($reservation->book_id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        try {
            $book->available = true;
            $book->save();

            $reservation->delete();

            return response()->json(['message' => 'Reservation canceled successfully'], 200);

        } catch (\Exception $e) {
            Log::error('Error canceling reservation: ' . $e->getMessage());
            return response()->json(['Error' => 'Failed to cancel the reservation.'], 500);
        }
    }
}