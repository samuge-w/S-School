<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTiggersForBookStock extends Migration {

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		$driver = DB::getDriverName();

		if ($driver === 'sqlite') {
			// SQLite-compatible triggers
			DB::unprepared('
			CREATE TRIGGER afterBookAdd AFTER INSERT ON Books
			BEGIN
				INSERT INTO bookStock (code, quantity)
				VALUES (NEW.code, NEW.quantity);
			END;
			');

			DB::unprepared('
			CREATE TRIGGER afterBookDelete AFTER DELETE ON Books
			BEGIN
				DELETE FROM issueBook WHERE code = OLD.code;
				DELETE FROM bookStock WHERE code = OLD.code;
			END;
			');

			DB::unprepared('
			CREATE TRIGGER afterBookUpdate AFTER UPDATE ON Books
			BEGIN
				UPDATE bookStock
				SET quantity = quantity + (NEW.quantity - OLD.quantity)
				WHERE code = OLD.code;
			END;
			');

			DB::unprepared('
			CREATE TRIGGER afterBorrowBookAdd AFTER INSERT ON issueBook
			BEGIN
				UPDATE bookStock
				SET quantity = quantity - NEW.quantity
				WHERE code = NEW.code;
			END;
			');

			DB::unprepared('
			CREATE TRIGGER afterBorrowBookDelete AFTER DELETE ON issueBook
			WHEN OLD.Status = "Borrowed"
			BEGIN
				UPDATE bookStock
				SET quantity = quantity + OLD.quantity
				WHERE code = OLD.code;
			END;
			');

			DB::unprepared('
			CREATE TRIGGER afterBorrowBookUpdate AFTER UPDATE OF Status ON issueBook
			WHEN NEW.Status = "Returned"
			BEGIN
				UPDATE bookStock
				SET quantity = quantity + NEW.quantity
				WHERE code = NEW.code;
			END;
			');
		} else {
			// Original MySQL/MariaDB triggers
			DB::unprepared('
			CREATE TRIGGER `afterBookAdd` AFTER INSERT ON `Books` FOR EACH ROW
			BEGIN
			insert into bookStock
			set
			code = new.code,
			quantity = new.quantity;
			END
			');
			//after book delete
			DB::unprepared('
			CREATE TRIGGER `afterBookDelete` AFTER DELETE ON `Books` FOR EACH ROW
			BEGIN
			delete from issueBook where code = old.code;
			delete from bookStock where code = old.code;
			END
			');
			//after book update
			DB::unprepared('
			CREATE TRIGGER `afterBookUpdate` AFTER UPDATE ON `Books` FOR EACH ROW
			BEGIN
			UPDATE bookStock
			set
			quantity = new.quantity-(old.quantity-quantity)
			WHERE code=old.code;
			END
			');
			//after borrow book add
			DB::unprepared('
			CREATE TRIGGER `afterBorrowBookAdd` AFTER INSERT ON `issueBook` FOR EACH ROW
			BEGIN
			UPDATE bookStock
			set quantity = quantity-new.quantity
			where code=new.code;
			END
			');
			//after borrow book delete
			DB::unprepared("\n\t\t\tCREATE TRIGGER `afterBorrowBookDelete` AFTER DELETE ON `issueBook` FOR EACH ROW\n\t\t\tIF (old.Status='Borrowed') THEN\n\t\t\tUPDATE bookStock\n\t\t\tset quantity = quantity+old.quantity\n\t\t\tWHERE code=old.code;\n\t\t\tEND IF\n\t\t\t");
			//after borrow book update
			DB::unprepared("\n\t\t\tCREATE TRIGGER `afterBorrowBookUpdate` AFTER UPDATE ON `issueBook` FOR EACH ROW\n\t\t\tIF (new.Status='Returned') THEN\n\t\t\tUPDATE bookStock\n\t\t\tset quantity = quantity+new.quantity\n\t\t\tWHERE code=new.code;\n\t\t\tEND IF\n\t\t\t");
		}

	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		$driver = DB::getDriverName();
		if ($driver === 'sqlite') {
			DB::unprepared('DROP TRIGGER IF EXISTS afterBookAdd;');
			DB::unprepared('DROP TRIGGER IF EXISTS afterBookDelete;');
			DB::unprepared('DROP TRIGGER IF EXISTS afterBookUpdate;');
			DB::unprepared('DROP TRIGGER IF EXISTS afterBorrowBookAdd;');
			DB::unprepared('DROP TRIGGER IF EXISTS afterBorrowBookDelete;');
			DB::unprepared('DROP TRIGGER IF EXISTS afterBorrowBookUpdate;');
		} else {
			DB::unprepared('DROP IF EXISTS TRIGGER `afterBookAdd`');
			DB::unprepared('DROP IF EXISTS TRIGGER `afterBookDelete`');
			DB::unprepared('DROP IF EXISTS TRIGGER `afterBookUpdate`');
			DB::unprepared('DROP IF EXISTS TRIGGER `afterBorrowBookAdd`');
			DB::unprepared("DROP IF EXISTS TRIGGER `afterBorrowBookDelete`");
			DB::unprepared("DROP IF EXISTS TRIGGER `afterBorrowBookUpdate`");
		}
	}

}
