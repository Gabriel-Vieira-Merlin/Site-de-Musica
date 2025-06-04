<?php
class Album {
    private $conn;
    private $table_name = "albums";

    public $id;
    public $user_id;
    public $title;
    public $artist;
    public $release_year;
    public $genre;
    public $rating;
    public $review;
    public $cover_url;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Criar novo álbum
    public function create() {
        $query = "INSERT INTO " . $this->table_name . "
                SET user_id=:user_id, title=:title, artist=:artist, 
                release_year=:release_year, genre=:genre, rating=:rating, 
                review=:review, cover_url=:cover_url";

        $stmt = $this->conn->prepare($query);

        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->artist = htmlspecialchars(strip_tags($this->artist));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->review = htmlspecialchars(strip_tags($this->review));
        $this->cover_url = htmlspecialchars(strip_tags($this->cover_url));

        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":artist", $this->artist);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":review", $this->review);
        $stmt->bindParam(":cover_url", $this->cover_url);

        return $stmt->execute();
    }

    // Ler todos os álbuns com filtros
    public function readAll($user_id, $filters = []) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";

        if (!empty($filters['title'])) {
            $query .= " AND title LIKE :title";
        }
        if (!empty($filters['artist'])) {
            $query .= " AND artist LIKE :artist";
        }
        if (!empty($filters['genre'])) {
            $query .= " AND genre = :genre";
        }
        if (!empty($filters['release_year'])) {
            $query .= " AND release_year = :release_year";
        }
        if (!empty($filters['rating'])) {
            $query .= " AND rating = :rating";
        }

        $query .= " ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);

        if (!empty($filters['title'])) {
            $title = "%" . $filters['title'] . "%";
            $stmt->bindParam(":title", $title);
        }
        if (!empty($filters['artist'])) {
            $artist = "%" . $filters['artist'] . "%";
            $stmt->bindParam(":artist", $artist);
        }
        if (!empty($filters['genre'])) {
            $stmt->bindParam(":genre", $filters['genre']);
        }
        if (!empty($filters['release_year'])) {
            $stmt->bindParam(":release_year", $filters['release_year']);
        }
        if (!empty($filters['rating'])) {
            $stmt->bindParam(":rating", $filters['rating']);
        }

        $stmt->execute();
        return $stmt;
    }

    // Ler um álbum específico
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->title = $row['title'];
            $this->artist = $row['artist'];
            $this->release_year = $row['release_year'];
            $this->genre = $row['genre'];
            $this->rating = $row['rating'];
            $this->review = $row['review'];
            $this->cover_url = $row['cover_url'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            return true;
        }
        return false;
    }

    // Atualizar álbum
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                SET title=:title, artist=:artist, release_year=:release_year, 
                genre=:genre, rating=:rating, review=:review, cover_url=:cover_url
                WHERE id=:id AND user_id=:user_id";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->artist = htmlspecialchars(strip_tags($this->artist));
        $this->release_year = htmlspecialchars(strip_tags($this->release_year));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->review = htmlspecialchars(strip_tags($this->review));
        $this->cover_url = htmlspecialchars(strip_tags($this->cover_url));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":artist", $this->artist);
        $stmt->bindParam(":release_year", $this->release_year);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":review", $this->review);
        $stmt->bindParam(":cover_url", $this->cover_url);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    // Excluir álbum
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);

        return $stmt->execute();
    }

    // Obter todos os gêneros distintos
    public function getGenres($user_id) {
        $query = "SELECT DISTINCT genre FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY genre";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }

    // Obter todos os anos distintos
    public function getYears($user_id) {
        $query = "SELECT DISTINCT release_year FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY release_year DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }

    // Obter todos os artistas distintos
    public function getArtists($user_id) {
        $query = "SELECT DISTINCT artist FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY artist";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt;
    }
}
