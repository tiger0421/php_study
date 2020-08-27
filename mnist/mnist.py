#!/usr/bin/env python
import numpy as np

import tensorflow as tf
from tensorflow import keras
from PIL import Image

model_full_path = "./mnist.h5"
model = keras.models.load_model(model_full_path)

# read image
img = (Image.open('image_dir/target_image.png').resize((28, 28)))
# gray scale
img = np.array(img.convert('L')) / 255
img = 1 - img
img_expand = img[np.newaxis, ...]

# save image
#tmp = Image.fromarray((img*255).astype(np.uint8))
#if tmp.mode != 'RGB':
#        tmp = tmp.convert('RGB')
#tmp.save('image_dir/mini_img.png')

predictions_single = model.predict(img_expand)
print(predictions_single.argmax())
