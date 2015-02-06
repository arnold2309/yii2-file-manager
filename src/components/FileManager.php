use yii\helpers\FileHelper;
    /**
     * @var string name of the file model class.
     */
    public $modelClass;
        if (!isset($this->modelClass)) {
            $this->modelClass = File::className();
        $modelClass = $this->modelClass;
        $modelConfig = ArrayHelper::remove($config, 'file', []);
        $name = ArrayHelper::remove($config, 'name', $resource->getName());
        $extension = ArrayHelper::remove($config, 'extension', $resource->getExtension());
        $folder = ArrayHelper::remove($config, 'path');
            'name' => $this->normalizeFilename($name),
            'folder' => FileHelper::normalizePath($folder),
        $storageConfig['filename'] = $model->getFilePath();
        if (!$this->getStorage($model->storage)->saveFile($resource, $storageConfig)) {
            throw new Exception("Failed to save file to storage '{$model->storage}'.");
        }
     * @return \yii\db\ActiveQuery active query instance.
    public function findFile()
        $modelClass = $this->modelClass;
        return $modelClass::find();
     * @return bool whether the operation was successful.
     * @throws Exception
        $model = $this->findFile()->where(['id' => $id])->one();
        $filename = $this->getFilePath($model);
        $model = $this->findFile()->where(['id' => $id])->one();
     * Returns the full path for a specific model.
     * @param File $model file model.
     * @return string file path.
    public function getFilePath(File $model)
        return $this->getStorage($model->storage)->getFilePath($model->getFilePath());
     * Returns the filename for a specific model.
     * @param File $model file model.
     * @return string filename.
    public function getFileName(File $model)
        return "{$model->name}-{$model->id}.{$model->extension}";
     * Normalizes the given filename by removing illegal characters.
     * @param string $name the filename.
     * @return string the normalized filename.
    protected function normalizeFilename($name)
        return strtolower(str_replace('+', '-', preg_replace('/%[A-Z0-9]{2}/', '', urlencode($name))));