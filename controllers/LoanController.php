<?php

namespace app\controllers;

use app\models\Loan;
use app\models\Member;
use app\models\Book;
use Yii;

class LoanController extends \yii\web\Controller
{   

    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        $loans = Loan::find()->all();
        return $this->asJson($loans);
    }

    private function errorResponse($message)
    {
        Yii::$app->response->statusCode = 400;
        return $this->asJson(['error' => $message]);
    }

    public function actionBorrow()
    {
        $request = Yii::$app->request;

        $bookId = $request->post('book_id');
        $book = Book::findOne($bookId);

        $response = $this->validateBook($book);
        $borrowerId = $request->post('member_id');
        $response2 = $this->validateBorrow($borrowerId);

        if($response !== 0){
            return $this->setMessage($response);
        }  else if($response2 !== 0) {
            return $this->setMessage($response2);
        }

        $loan = new Loan();
        $returnDate = strtotime('+ 1 month');
        $loan->attributes = [
            'book_id' => $bookId,
            'borrower_id' => $borrowerId,
            'borrowed_on'=> date('Y-m-d H:i:s'),
            'date_return'=> date('Y-m-d H:i:s', $returnDate)
        ];

        $book->markAsBorrowed();
        $loan->save();

        return $this->asJson($loan);

    }

    private function validateBook($book)
    {
        if(is_null($book)) {            
            return 1;
        }

        if(!$book->is_available_for_loan) {
            return 2;
        }

        return 0;
        
    }

    private function validateBorrow($borrower)
    {
        if(is_null(Member::findOne($borrower))) {
            return 3;
        }

        return 0;
    }

    private function setMessage($number)
    {
        switch ($number) {
            case 1:
                return $this->errorResponse('Could not find this book');
                break;
            case 2:
                return $this->errorResponse('This book is not available to loan');
                break;
            case 3:
                return $this->errorResponse('This member does not exists');
                break;         
            default:
                return $this->errorResponse('Something wrong happened :(');
                break;
        }
    }

}
