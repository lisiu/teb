import * as React from 'react'
import {FC} from 'react'
import Button from 'react-bootstrap/Button';

interface Props {
    onClick: () => void;
}

const StepBackward: FC<Props> = ({onClick}: Props) => {
    const handleClick = () => {
        onClick()
    }

    return (
        <Button variant="outline-secondary" size="lg" block onClick={handleClick}>Wstecz</Button>
    )
}

export default StepBackward
