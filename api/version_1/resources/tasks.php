<?php

class Tasks extends Resource {

    public $accept = array(
        'text/plain',
        'text/html',
        'application/json'
    );

    /*
     * GET /tasks
     */
    public function get() {
        $this->accept = array('application/jsons');

        $users = Database::select('SELECT * FROM task');

        return $this->response->body(200, $users);
    }

    /*
     * GET /tasks/1
     */
    public function detail() {
        $user = Database::select('SELECT * FROM task WHERE id = ?', array(
            $this->request->url->id
        ));

        return $this->response->body(200, $user);
    }

    /*
     * POST /tasks
     */
    public function post() {
        $post_data = $this->request->url->query;
        // sanitize
        $post_user_id = empty($post_data['user_id']) ? '' : $post_data['user_id'];
        $post_title = empty($post_data['title']) ? '' : htmlspecialchars(strip_tags($post_data['title']));
        $post_description = empty($post_data['description']) ? '' : htmlspecialchars(strip_tags($post_data['description']));
        $post_status = empty($post_data['status']) ? '' : $post_data['status'];

        if (!empty($post_user_id.$post_title.$post_description.$post_status)) {
            $user_id = Database::insert('INSERT INTO task (`user_id`, `title`, `description`, `status`) VALUES (?, ?, ?, ?)', array(
                $post_user_id, $post_title, $post_description, $post_status
            ));
            return $this->response->body(201, $user_id);
        } else {
            return $this->response->status(406, 'task data empty !');
        }
    }

    /*
     * DELETE /tasks/1
     */
    public function delete() {
        $result = Database::remove('DELETE FROM task WHERE id = ?', array(
            $this->request->url->id
        ));
        if (!$result)
            return $this->response->body(204, $result);
        else
            return $this->response->status(200, 'task delete successful !');
    }
}