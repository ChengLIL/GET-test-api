<?php

class TasksByUser extends Resource {

    public $accept = array(
        'text/plain',
        'text/html',
        'application/json'
    );

    /*
     * GET /tasksByUser/1
     */
    public function detail() {
        $tasks = Database::select('SELECT * FROM task WHERE user_id = ?', array(
            $this->request->url->id
        ));

        return $this->response->body(200, $tasks);
    }

    /*
     * POST /tasksByUser/1
     */
    public function post() {
        $post_data = $this->request->url->query;
        if(empty($post_data)) {
            $post_data = $this->request->input;
        }
        // sanitize
        $post_title = empty($post_data['title']) ? '' : htmlspecialchars(strip_tags($post_data['title']));
        $post_description = empty($post_data['description']) ? '' : htmlspecialchars(strip_tags($post_data['description']));
        $post_status = empty($post_data['status']) ? '' : $post_data['status'];

        if(!empty($post_title.$post_description.$post_status)) {
            $task_id = Database::insert('INSERT INTO task (`user_id`, `title`, `description`, `status`) VALUES (?, ?, ?, ?)', array(
                $this->request->url->id, $post_title, $post_description, $post_status
            ));
            return $this->response->body(201, $task_id);
        } else {
            return $this->response->status(406, 'task data empty !');
        }
    }

    /*
     * DELETE /tasksByUser/1
     */
    public function delete() {
        $result = Database::remove('DELETE FROM task WHERE user_id = ?', array(
            $this->request->url->id
        ));
        if(!$result)
            return $this->response->body(204, $result);
        else
            return $this->response->status(200, 'task delete successful !');
    }
}