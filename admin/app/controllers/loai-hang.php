<?php



class Loai_hang

{

    private $modelLoaiHang;



    public function __construct()

    {

        $this->modelLoaiHang = new ModelLoaihang();

    }



    private function pdo(): ?PDO

    {

        return (new Database())->getConnection();

    }



    private function categoryMessages(): array

    {

        return [

            'ten_loai.required' => 'Tên danh mục không được để trống.',

            'ten_loai.min'      => 'Tên danh mục không hợp lệ.',

            'ten_loai.max'      => 'Tên danh mục quá dài.',

            'ten_loai.unique'   => 'Danh mục này đã tồn tại.',

            'id.required'       => 'Danh mục không hợp lệ.',

            'id.integer'        => 'Danh mục không hợp lệ.',

            'id.min_value'      => 'Danh mục không hợp lệ.',

            'id.exists'         => 'Danh mục không tồn tại.',

        ];

    }



    private function countRows(string $sql, array $bindings): ?int

    {

        $pdo = $this->pdo();

        if (!$pdo instanceof PDO) {

            return null;

        }



        try {

            $stmt = $pdo->prepare($sql);

            $stmt->execute($bindings);



            return (int) $stmt->fetchColumn();

        } catch (Throwable $e) {

            return null;

        }

    }



    private function categoryHasProducts(int $categoryId): bool

    {

        $count = $this->countRows(

            'SELECT COUNT(*) FROM san_pham WHERE loai_hang_id = :id',

            [':id' => $categoryId]

        );



        return $count === null ? false : $count > 0;

    }



    private function validateCategoryId($id): ?int

    {

        $validator = Validator::make(

            ['id' => $id],

            ['id' => 'required|integer|min_value:1|exists:loai_hang,id'],

            $this->categoryMessages(),

            $this->pdo()

        );



        if ($validator->fails()) {

            return null;

        }



        return (int) $id;

    }



    public function index()

    {

        $loai_hang = $this->modelLoaiHang->loaiHang();

        require __DIR__ . '/../views/list-loai-hang.php';

    }



    public function create()

    {

        $errors = form_get_errors();



        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $validator = Validator::make($_POST, [

                'ten_loai' => 'required|min:2|max:100|unique:loai_hang,ten_loai',

            ], $this->categoryMessages(), $this->pdo());



            if ($validator->fails()) {

                Validator::flashInput($_POST);

                form_set_errors($validator->errorsFlat());

                $errors = form_get_errors();

                require __DIR__ . '/../views/create-loai-hang.php';

                return;

            }



            $ten_loai = trim($_POST['ten_loai'] ?? '');

            $this->modelLoaiHang->create_loai_hang($ten_loai);

            form_flash_success('Thêm loại hàng thành công.');

            header("Location: index.php?controller=loai_hang&action=index");

            exit();

        }



        require __DIR__ . '/../views/create-loai-hang.php';

    }



    public function delete()

    {

        $categoryId = $this->validateCategoryId($_GET['id'] ?? '');

        if ($categoryId === null) {

            form_flash_error('Danh mục không tồn tại.');

            header("Location: index.php?controller=loai_hang&action=index");

            exit();

        }



        if ($this->categoryHasProducts($categoryId)) {

            form_flash_error('Không thể xóa danh mục này.');

            header("Location: index.php?controller=loai_hang&action=index");

            exit();

        }



        $this->modelLoaiHang->delete_loai_hang($categoryId);

        form_flash_success('Xóa danh mục thành công.');

        header("Location: index.php?controller=loai_hang&action=index");

        exit();

    }



    public function update()

    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $pdo = $this->pdo();

            $categoryId = (int) ($_POST['id'] ?? 0);



            $validator = Validator::make($_POST, [

                'id'       => 'required|integer|min_value:1|exists:loai_hang,id',

                'ten_loai' => 'required|min:2|max:100|unique:loai_hang,ten_loai,id,' . $categoryId,

            ], $this->categoryMessages(), $pdo);



            if ($validator->fails()) {

                Validator::flashInput($_POST);

                form_set_errors($validator->errorsFlat());

                $errors = form_get_errors();

                $list_loai = $this->modelLoaiHang->find($categoryId) ?: [];

                require __DIR__ . '/../views/update-loai-hang.php';

                return;

            }



            $id = (int) ($_POST['id'] ?? 0);

            $ten_loai = trim($_POST['ten_loai'] ?? '');

            $this->modelLoaiHang->update_loai_hang($id, $ten_loai);

            form_flash_success('Cập nhật loại hàng thành công.');

            header("Location: index.php?controller=loai_hang&action=index");

            exit();

        }



        $categoryId = $this->validateCategoryId($_GET['id'] ?? '');

        if ($categoryId === null) {

            form_flash_error('Danh mục không tồn tại.');

            header("Location: index.php?controller=loai_hang&action=index");

            exit();

        }



        $list_loai = $this->modelLoaiHang->find($categoryId);

        $errors = form_get_errors();

        require __DIR__ . '/../views/update-loai-hang.php';

    }

}


